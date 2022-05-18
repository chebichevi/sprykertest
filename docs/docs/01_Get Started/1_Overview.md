---
title: Overview
slug: /
---

## Application Layer

This layer has a service:

1. The API, built with [Symfony 5](https://symfony.com/), [TDBM](https://github.com/thecodingmachine/tdbm).

## Data Layer

This layer has 1 service:

1. MySQL for storing sessions and business data.
:::note

📣&nbsp;&nbsp;In production, you may externalize them to the equivalent services from your provider.

:::

## Additional Services

These services are mostly useful in development:

1. [Traefik](https://doc.traefik.io/traefik/), a reverse proxy.
2. phpMyAdmin, a web UI for displaying your database's data.