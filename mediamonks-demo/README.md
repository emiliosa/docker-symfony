MediaMonks-Demo
===============

# Requirements

* PHP 7.1.3 or higher;
* PDO-SQLite PHP extension enabled;
* and the [usual Symfony application requirements][1].

# Installation

Execute this command to install dependencies:

```bash
$ composer install
$ php bin/console doctrine:database:create
$ php bin/console doctrine:schema:update --force
$ php bin/console doctrine:fixtures:load
$ php bin/console assets:install
$ sudo chmod -R 777 var/
```

# Webpack

Using docker execute:

```bash
$ docker exec -it dockersymfony_nodejs_1 yarn install
$ docker exec -it dockersymfony_nodejs_1 yarn run encore dev
```

# Configuration

1. Create a `.env` from the `.env.dist` file

```sh
$ cp .env.dist .env
```

2. Create google oauth client-id:

<https://console.developers.google.com/apis/>

Browser request: `http://localhost.mediamonks-demo.com`
URI Redirect: `http://localhost.mediamonks-demo.com/connect/google/check`

3. Add google `CLIENTE_ID` and `CLIENT_SECRET` on `.env` file

# Usage

Access the application in your browser at <http://localhost.mediamonks-demo.com>:
