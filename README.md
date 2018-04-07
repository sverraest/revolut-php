[![Build Status](https://travis-ci.org/sverraest/revolut-php.svg?branch=master)](https://travis-ci.org/sverraest/revolut-php)
[![codecov](https://codecov.io/gh/sverraest/revolut-php/branch/master/graph/badge.svg)](https://codecov.io/gh/sverraest/revolut-php)

## RevolutPHP

> (Unofficial) PHP API Client and bindings for the [Revolut Business API](https://revolutdev.github.io/business-api/?shell--sandbox#api-v1-0-introduction).

## Installation

Requires PHP 7.0 or higher

The recommended way to install revolut-php is through [Composer](https://getcomposer.org):

First, install Composer:

```
$ curl -sS https://getcomposer.org/installer | php
```

Next, install the latest revolut-php:

```
$ php composer.phar require sverraest/revolut-php
```

Finally, you need to require the library in your PHP application:

```php
require "vendor/autoload.php";
```

## RevolutPHP\Client
First get your `production` or `sandbox` API key from [Revolut for Business](https://business.revolut.com/settings/api).

If you want to get a `production` client:

```php
use RevolutPHP\Client;

$client = new Client('apikey');
```

If you want to get a `sandbox` client:

```php
use RevolutPHP\Client;

$client = new Client('apikey', 'sandbox');
```

If you want to pass additional [GuzzleHTTP](https://github.com/guzzle/guzzle) options:

```php
use RevolutPHP\Client;

$options = ['headers' => ['foo' => 'bar']];
$client = new Client('apikey', 'sandbox', $options);
```
