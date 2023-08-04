[![](https://img.shields.io/github/license/mam-luk/aybak.svg)](https://github.com/mam-luk/aybak/blob/master/LICENSE)

<p align="center"><img src=".mamluk/logo-horizontal.svg" alt="Kipchak by Mamluk" title="Kipchak by Mamluk - an API Toolkit" width="377"/>
</p>

# Aybak Piplines with GitHub Actions to automatically update load balancers in front of your Kubernetes Cluster
GitHub Actions Samples to work alongside Aybak for automating upgrades to Load Balancers with Kubernetes

This repo is a sample repo with pipelines to show you what Aybak (https://github.com/mam-luk/aybak) writes to the git repo you provide and how it updates your load balancers.

To use it:

1. Fork this repo.
2. Create a .github folder.
3. Copy the workflows folder into the github folder.
4. Rename the file(s) in the .github/workflows folder to your cluster names and change the variables in those files accordingly. You can add as many as you write, but there should be a json file written in the nodes folder each of the clusters you have (this is what Aybak will write for you). The following need to be changed: https://github.com/mam-luk/aybak-pipelines-template/blob/master/workflows/london.yml#L7, https://github.com/mam-luk/aybak-pipelines-template/blob/master/workflows/london.yml#L23, https://github.com/mam-luk/aybak-pipelines-template/blob/master/workflows/london.yml#L30, https://github.com/mam-luk/aybak-pipelines-template/blob/master/workflows/london.yml#L31, https://github.com/mam-luk/aybak-pipelines-template/blob/master/workflows/london.yml#L32, https://github.com/mam-luk/aybak-pipelines-template/blob/master/workflows/london.yml#L40,
https://github.com/mam-luk/aybak-pipelines-template/blob/master/workflows/london.yml#L45
5. Deploy Aybak, and make sure you configure it to write to this git repo.

### Credits
This utility has been built for Mamluk (https://mamluk.net), 7x (https://7x.ax) and Islamic Network (https://islamic.network)
