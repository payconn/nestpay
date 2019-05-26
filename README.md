# Nestpay

**Nestpay (Axess, Bonus, Cardfinans, Maximum, Paraf, World) gateway for Payconn payment processing library**

[![Build Status](https://travis-ci.com/payconn/nestpay.svg?branch=master)](https://travis-ci.com/payconn/nestpay)

[Payconn](https://github.com/payconn/common) is a framework agnostic, multi-gateway payment
processing library for PHP. This package implements common classes required by Payconn.

## Installation

    composer require payconn/nestpay:~1.0

## Supported card families
* Axess
* Bonus
* Cardfinans
* Maximum
* Paraf
* World

## Supported methods
* purchase
* authorize
* purchaseComplete
* void
* refund

## Basic Usage
```php
$token = new \Payconn\Nestpay\Token('YOUR_CLIENT_ID', 'YOUR_USERNAME', 'YOUR_PASS');
$gateway = new \Payconn\Nestpay($token);
$creditCard = new \Payconn\Common\CreditCard('Holder Name', '4355084355084358', '26', '12', '000');
$response = $gateway->purchase([
    'creditCard' => $creditCard,
    'amount' => 1,
    'installment' => 1,
    'testMode' => true,
    'currency' => \Payconn\Nestpay\Currency::TRY,
    'endpoint' => (new \Payconn\Nestpay\Endpoint\Axess(true))->getBaseUrl(),
]);
```

## Change log

Please see [UPGRADE](UPGRADE.md) for more information on how to upgrade to the latest version.

## Support

If you are having general issues with Payconn, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/payconn/nestpay/issues),
or better yet, fork the library and submit a pull request.


## Security

If you discover any security related issues, please email muratsac@mail.com instead of using the issue tracker.


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
