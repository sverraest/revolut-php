# RevolutPHP

> (Unofficial) PHP API Client and bindings for the [Revolut Business API](https://revolutdev.github.io/business-api/?shell--sandbox#api-v1-0-introduction).

[![Build Status](https://travis-ci.org/sverraest/revolut-php.svg?branch=master)](https://travis-ci.org/sverraest/revolut-php)
[![codecov](https://codecov.io/gh/sverraest/revolut-php/branch/master/graph/badge.svg)](https://codecov.io/gh/sverraest/revolut-php)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sverraest/revolut-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sverraest/revolut-php/?branch=master)
[![Maintainability](https://api.codeclimate.com/v1/badges/c24e78a43d1134aaf1b4/maintainability)](https://codeclimate.com/github/sverraest/revolut-php/maintainability)

Using this PHP API Client you can interact with your:
- 💰 __Accounts__
- 🏢 __Counterparties__
- 💸 __Payments__
- 🔀 __Transfers__ 
- 📊 __Transactions__
- 🔗 __Webhooks__


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

## Development

- Run `composer test` and `composer phpcs` before creating a PR to detect any obvious issues.
- Please create issues for this specific API Binding under the [issues](https://github.com/sverraest/revolut-php/issues) section.
- [Contact Revolut](https://business.revolut.com/signin) directly for official Revolut For Business API support.


## Quick Start
### RevolutPHP\Client
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

## Available API Operations

The following exposed API operations from the Revolut For Business API are available using the API Client.

See below for more details about each resource.

💰 __Accounts__

Get all accounts, Get a specific account and get details for a specific account.

🏢 __Counterparties__

Get all counterparties, get a specific counterparty, create a new counterparty and delete a counterparty.

💸 __Payments__

Create and schedule new payments.

🔀 __Transfers__

Create a transfer between your accounts.

📊  __Transactions__

Get all transactions or a subset (with queryFilters), cancel a scheduled transaction, get a specific transaction and get a transaction by the unique specified requestId.

A Transaction is either created as a Payment or a Transfer.

🔗 __Webhooks__

Create new webhooks.

## Usage details

### 💰 Accounts
#### Get all accounts
See more at [https://revolutdev.github.io/business-api/#get-accounts](https://revolutdev.github.io/business-api/#get-accounts)

```php
use RevolutPHP\Client;

$client = new Client('apikey');
$accounts = $client->accounts->all();
```

#### Get one account
See more at [https://revolutdev.github.io/business-api/#get-account](https://revolutdev.github.io/business-api/#get-account)

```php
use RevolutPHP\Client;

$client = new Client('apikey');
$account = $client->accounts->get('foo');
```

#### Get account details
See more at [https://revolutdev.github.io/business-api/#get-account-details](https://revolutdev.github.io/business-api/#get-account-details)

```php
use RevolutPHP\Client;

$client = new Client('apikey');
$account = $client->accounts->getDetails('foo');
```

### 🏢 Counterparties
#### Add a Counterparty
See more at [https://revolutdev.github.io/business-api/#add-revolut-counterparty](https://revolutdev.github.io/business-api/#add-revolut-counterparty) and [https://revolutdev.github.io/business-api/#add-non-revolut-counterparty](https://revolutdev.github.io/business-api/#add-non-revolut-counterparty)

```php
use RevolutPHP\Client;

$client = new Client('apikey');
$counterparty = $client->counterparties->create(['profile_type' => 'business', 'name' => 'TestCorp' , 'email' => 'test@sandboxcorp.com']);
```

#### Delete a Counterparty
See more at [https://revolutdev.github.io/business-api/#delete-counterparty](https://revolutdev.github.io/business-api/#delete-counterparty)

```php
use RevolutPHP\Client;

$client = new Client('apikey');
$client->counterparties->delete('foo');
```

#### Get all Counterparties
See more at [https://revolutdev.github.io/business-api/#get-counterparties](https://revolutdev.github.io/business-api/#get-counterparties)

```php
use RevolutPHP\Client;

$client = new Client('apikey');
$counterparties = $client->counterparties->all();
```

#### Get a specific Counterparty
See more at [https://revolutdev.github.io/business-api/#get-counterparty](https://revolutdev.github.io/business-api/#get-counterparty)

```php
use RevolutPHP\Client;

$client = new Client('apikey');
$counterparty = $client->counterparties->get('bar');
```

### 💸 Payments
#### Create a payment
See more at [https://revolutdev.github.io/business-api/#create-payment](https://revolutdev.github.io/business-api/#create-payment)

```php
use RevolutPHP\Client;

$client = new Client('apikey');

$payment = [
  'request_id' => 'e0cbf84637264ee082a848b',
  'account_id' => 'bdab1c20-8d8c-430d-b967-87ac01af060c',
  'receiver' => [
    'counterparty_id': '5138z40d1-05bb-49c0-b130-75e8cf2f7693',
    'account_id': 'db7c73d3-b0df-4e0e-8a9a-f42aa99f52ab'
  ],
  'amount' => 123.11,
  'currency' => 'EUR',
  'reference' => 'Invoice payment #123'
];

$payment = $client->payments->create($payment);
```

#### Schedule a payment (for up to 30 days in the future)
See more at [https://revolutdev.github.io/business-api/#schedule-payment](https://revolutdev.github.io/business-api/#schedule-payment)

```php
use RevolutPHP\Client;

$client = new Client('apikey');

$payment = [
  'request_id' => 'e0cbf84637264ee082a848b',
  'account_id' => 'bdab1c20-8d8c-430d-b967-87ac01af060c',
  'receiver' => [
    'counterparty_id': '5138z40d1-05bb-49c0-b130-75e8cf2f7693',
    'account_id': 'db7c73d3-b0df-4e0e-8a9a-f42aa99f52ab'
  ],
  'amount' => 123.11,
  'currency' => 'EUR',
  'reference' => 'Invoice payment #123',
  'schedule_for' => '2018-04-20',
];

$payment = $client->payments->create($payment);
```

### 🔀 Transfers
#### Transfer money between your accounts
See more at [https://revolutdev.github.io/business-api/#transfer](https://revolutdev.github.io/business-api/#transfer)

```php
use RevolutPHP\Client;

$client = new Client('apikey');

$transfer = [
  'request_id' => 'e0cbf84637264ee082a848b',
  'source_account_id' => 'bdab1c20-8d8c-430d-b967-87ac01af060c',
  'target_account_id' => '5138z40d1-05bb-49c0-b130-75e8cf2f7693',
  'amount' => 123.11,
  'currency' => 'EUR',
  'description' => 'Expenses funding'
];

$transfer = $client->transfers->create($payment);
```

### 📊 Transactions
#### Get a specific transaction (Transfer, Payment)
See more at [https://revolutdev.github.io/business-api/#check-payment-status](https://revolutdev.github.io/business-api/#check-payment-status)

```php
use RevolutPHP\Client;

$client = new Client('apikey');
$transaction = $client->transactions->get('foo');
```

#### Get a specific transaction by requestId (Transfer, Payment)
You can fetch a transaction by the requestId that you specified on creation.
See more at [https://revolutdev.github.io/business-api/#check-payment-status](https://revolutdev.github.io/business-api/#check-payment-status)

```php
use RevolutPHP\Client;

$client = new Client('apikey');
$transaction = $client->transactions->getByRequestId('inv-123456789');
```

#### Cancel a scheduled transaction
See more at [https://revolutdev.github.io/business-api/#cancel-payment](https://revolutdev.github.io/business-api/#cancel-payment)

```php
use RevolutPHP\Client;

$client = new Client('apikey');
$client->transactions->cancel('foo');
```

#### Get all transactions
See more at [https://revolutdev.github.io/business-api/#get-transactions](https://revolutdev.github.io/business-api/#get-transactions)

```php
use RevolutPHP\Client;

$client = new Client('apikey');
$transactions = $client->transactions->all();
```

#### Get all transactions with filters applied
See more at [https://revolutdev.github.io/business-api/#get-transactions](https://revolutdev.github.io/business-api/#get-transactions)

```php
use RevolutPHP\Client;

$client = new Client('apikey');

$searchFilters = [
  'from' => '2018-01-01', 
  'to' => '2018-04-01', 
  'count' => 50, 
  'counterparty' => 'foo', 
  'type' => 'transfer'
];

$transactions = $client->transactions->all($searchFilters);
```

### 🔗 Webhooks
#### Create a webhook
See more at [https://revolutdev.github.io/business-api/#web-hooks](https://revolutdev.github.io/business-api/#web-hooks)

```php
use RevolutPHP\Client;

$client = new Client('apikey');

$webhook = [
  'url' => 'https://foo.bar',
];

$webhook = $client->webhooks->create($webhook);
```
## Errors
Currently the following errors are defined in the Revolut Business API.

| Error                       | Description                                                        |
| --------------------------- |--------------------------------------------------------------------| 
| 400	Bad request           | Your request is invalid.                                             |
| 401	Unauthorized          | Your API key is wrong.                                               |
| 403	Forbidden             | Access to the requested resource or action is forbidden.             |
| 404	Not Found             | The requested resource could not be found.                           |
| 405	Method Not Allowed    | You tried to access an endpoint with an invalid method.              |
| 406	Not Acceptable        | You requested a format that isn't JSON.                              |
| 429	Too Many Requests     | You're sending too many requests.                                    |
| 500	Internal Server Error | We had a problem with our server. Try again later.                   |
| 503	Service Unavailable   | We're temporarily offline for maintenance. Please try again later.   | 

## About

I'm a big fan of Revolut and I use them both at [Appfleet](https://appfleet.uk) and personally. If you need to build your PHP application on top of the Revolut For Business API this is the library you should use.
You can follow me on 🐦 [Twitter](https://www.twitter.com/simondoestech) or ✉️ email me at simon[-at-]appfleet.uk.
