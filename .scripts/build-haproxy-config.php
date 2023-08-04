#!/usr/bin/php

<?php
$config = require_once('_config.php');

$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(realpath(__DIR__ . '/../nodes')));
$clusters = array_keys(array_filter(iterator_to_array($iterator), function(SplFileInfo $file) {
    return $file->isFile() && $file->getExtension() === 'json';
}));

foreach ($clusters as $cluster) {
    $clusterName = basename($cluster, '.json');
    $fileName = basename($cluster);
    $fileNameWithPath = realpath($cluster);
    if (getenv('CLUSTER') === $clusterName) {
        // Get Nodes and IPs
        $nodes = json_decode(file_get_contents($fileNameWithPath));
        // Get Node IPs
        $ips = [];
        foreach ($nodes as $node) {
            $ips[] = $node->InternalIP;
        }
        // Create Cluster HA Proxy Config Backend lines
        $haProxyLines = [];
        $haProxyLines['http'] = [];
        $haProxyLines['https'] = [];
        $count = 0;
        foreach ($ips as $ip) {
            $count++;
            $haProxyLines['http'][] = "server s$count $ip:{$config['haproxy']['ports']['http']} maxconn {$config['haproxy']['maxconns']['http']} check {$config['haproxy']['proxyprotocol']['v2']}";
            $haProxyLines['https'][] = "server s$count $ip:{$config['haproxy']['ports']['https']} maxconn {$config['haproxy']['maxconns']['https']} check {$config['haproxy']['proxyprotocol']['v2']}";
        }

        $haProxyTemplate = file_get_contents('../.templates/haproxy.template.cfg');
        $haProxyConfig = str_replace(
            [
                "<<HAPROXY_BACKEND_SERVERS_HTTP>>",
                "<<HAPROXY_BACKEND_SERVERS_HTTPS>>",
                "<<HAPROXY_STATS_USERNAME>>",
                "<<HAPROXY_STATS_PASSWORD>>",
            ],
            [
                implode("\n   ", $haProxyLines['http']),
                implode("\n   ", $haProxyLines['https']),
                getenv('STATS_USERNAME'),
                getenv('STATS_PASSWORD'),
            ],
            $haProxyTemplate
        );

        file_put_contents("../tmp/$clusterName.cfg", $haProxyConfig);
    }

}
