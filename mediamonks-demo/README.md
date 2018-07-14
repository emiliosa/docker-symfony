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
$ php bin/console doctrine:fixtures:load
```

# Configuration

1. Create a `.env` from the `.env.dist` file

```sh
$ cp .env.dist .env
```

2. Create google oauth client-id:

<https://console.developers.google.com/apis/>

`Broser request: http://localhost.mediamonks-demo.com`
`URI Redirect: http://localhost.mediamonks-demo.com/connect/google/check`

3. Add google `CLIENTE_ID` and `CLIENT_SECRET` on `.env` file

# Usage

Access the application in your browser at <http://localhost.mediamonks-demo.com>:
