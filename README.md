# Nestpay

**Nestpay (Axess, Bonus, Cardfinans, Maximum, Paraf, World) gateway for Payconn payment processing library**

[![Build Status](https://travis-ci.com/payconn/nestpay.svg?branch=master)](https://travis-ci.com/payconn/nestpay)

[Payconn](https://github.com/payconn/common) is a framework agnostic, multi-gateway payment
processing library for PHP. This package implements common classes required by Payconn.

## Installation

    composer require payconn/nestpay:~1.1.4

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
* refund

## Basic Usage
```php
$token = new \Payconn\Nestpay\Token('CLIENT_ID', 'USERNAME', 'PASS');
$gateway = new \Payconn\Axess($token);
$creditCard = new \Payconn\Common\CreditCard('4355084355084358', '26', '12', '000');
$purchase = (new \Payconn\Nestpay\Model\Purchase($token))
    ->setInstallment(1)
    ->setAmount(1)
    ->setCurrency(\Payconn\Nestpay\Currency::TRY)
    ->setCreditCard($creditCard)
    ->setTestMode(true);
$response = $gateway->purchase($purchase);
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
