Docker for Symfony proyects
===========================

Includes:

    .Symfony4 (with Flex)
    .Sqlite3
    .PHP-FPM 7
    .Nginx
    .NodeJS (for webpack)
    .ELK (Elasticsearch, Logstash, Kibana)

# Installation

First, clone this repository:

```bash
$ git clone https://github.com/emiliosa/docker-symfony.git
```

1. Symfony app into `mediamonks-demo` folder.
2. Add into host file `127.0.0.1 localhost.mediamonks-demo.com`

```bash
$ docker-compose up -d
```

Rebuild images

```bash
$ docker-compose build
```

Now, follow `mediamonks-demo` Readme.

# Usage

Access inside container (you can execute `composer` or `php bin/console` commands):
```bash
$ docker exec -it dockersymfony_php_1 sh
```

Overwhise you execute from outside:
```bash
$ docker exec -it dockersymfony_php_1 composer install
$ docker exec -it dockersymfony_php_1 php bin/console
$ docker exec -it dockersymfony_nodejs_1 yarn
```

# Read logs

You can access Nginx and Symfony application logs in the following directories on your host machine:

* `logs/nginx`
* `logs/symfony`

# Use Kibana

You can also use Kibana to visualize Nginx & Symfony logs by visiting <http://localhost.mediamonks-demo.com:81>
