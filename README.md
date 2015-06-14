# Scheduling Rest API

This contains a sample REST API for scheduling. It uses the [Spark](https://github.com/sparkphp/Spark)
framework and is a PSR-7 compliant [Action-Domain-Responder](https://github.com/pmjones/adr)
(ADR) system. It's also [PSR-1](http://www.php-fig.org/psr/psr-1/),
[PSR-2](http://www.php-fig.org/psr/psr-2/), and [PSR-4](http://www.php-fig.org/psr/psr-4/) compliant.

## Installing Dependencies

You will need [Composer](https://getcomposer.org) to get setup.

```bash
composer install
```

## Migrate Database

Migrations are handled using Phinx.

```bash
php vendor/bin/phinx migrate -e development
```

This will install a SQLite database.

Confirm the installation by changing into the project directory and starting the
built-in PHP web server:

```bash
cd spark-project
php -S localhost:8000 -t web/
```

You can then browse to <http://localhost:8000/shifts> and see JSON output:

```json
{"shifts": []}
```

You can also browse to <http://localhost:8000/shifts?user_id=1> and see modified JSON output:

```json
{"meta": {}, "shifts": []}
```
