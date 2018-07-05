@extends('layouts.app')
@section('title', 'Project: nmiller.info')

@section('content')

# Project: nmiller.info

**nmiller.info** is my personal website. It's written in PHP and is built on
the awesome [Lumen](https://lumen.laravel.com/) micro-framework.

The site is hosted on a small
[DigitalOcean Droplet](https://www.digitalocean.com/products/droplets/)
running nginx and php-fpm.

I've leveraged [Let's Encrypt](https://letsencrypt.org/)'s free CA to ensure
the site is served securely via HTTPS.

[![Picture of nmiller.info](/images/projects/nmiller.info.png "nmiller.info")](/images/projects/nmiller.info.png)

I work on the website locally using [Docker](https://www.docker.com/), which
spins up [nginx](https://nginx.org/en/) and php-fpm services to emulate the
"production" droplet.

Internally, the site simply renders markdown files as Blade templates,
displaying them based on the current path.
@endsection
