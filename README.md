# Payconn: Nestpay (EST)

**Nestpay (A Bank, Ak Bank, Anadolu Bank, Finans Bank, Halk Bank, ING Bank, İş Bank, Şeker Bank, Türk Ekonomi Bank (TEB), Ziraat Bank) gateway for Payconn payment processing library**

[![Build Status](https://travis-ci.com/payconn/nestpay.svg?branch=master)](https://travis-ci.com/payconn/nestpay)

[Payconn](https://github.com/payconn/common) is a framework agnostic, multi-gateway payment
processing library for PHP. This package implements common classes required by Payconn.

## Installation

    composer require payconn/nestpay:~1.1.7

## Supported methods
* purchase
* authorize
* complete
* refund
* cancel

## Basic Usages

```php
use Payconn\Common\CreditCard;
use Payconn\Nestpay\Token;
use Payconn\Nestpay\Currency;
use Payconn\Nestpay\Model\Purchase;
use Payconn\Akbank;

$token = new Token('CLIENT_ID', 'USERNAME', 'PASS');
$creditCard = new CreditCard('4355084355084358', '26', '12', '000');
$purchase = new Purchase();
$purchase->setAmount(1);
$purchase->setInstallment(1);
$purchase->setCurrency(Currency::TRY);
$purchase->setCreditCard($creditCard);
$purchase->setTestMode(true);
$response = (AkBank($token))->purchase($purchase);
if($response->isSuccessful()){
    // success!
}
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
