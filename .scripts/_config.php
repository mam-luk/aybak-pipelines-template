<?php

return [
    'haproxy' => [
          'ports' =>
            [
                'http' => 32080,
                'https' => 32443,
            ],
            'maxconns' => [
                'http' => 10000,
                'https' => 10000,
            ],
            'proxyprotocol' => [
                'v1' => 'send-proxy',
                'v2' => 'send-proxy-v2'
            ]
        ]
];
