# Pachca logger for Laravel 8
Laravel Monolog handler for https://pachca.com

## Requirements

- php 8.0 and above
- Laravel 8

## Install

```
composer require docentbf/laravel-pachca-logger
```

## Usage

- Add `LOG_PACHCA_WEBHOOK` into your `.env` file.

- Add config to `channels` section in configuration file `config/logging.php`:

```php
'pachca' => [
    'driver'     => 'custom',
    'via'        => \DocentBF\LaravelPachcaLogger\PachcaLogger::class,
    'webhookUrl' => env('LOG_PACHCA_WEBHOOK'),
    'level'      => env('LOG_LEVEL', 'debug')
]

```
