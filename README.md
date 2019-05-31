# Nestpay

**Nestpay (A Bank, Ak Bank, Anadolu Bank, Finans Bank, Halk Bank, ING Bank, İş Bank, Şeker Bank, Türk Ekonomi Bank (TEB), Ziraat Bank) gateway for Payconn payment processing library**

[![Build Status](https://travis-ci.com/payconn/nestpay.svg?branch=master)](https://travis-ci.com/payconn/nestpay)

[Payconn](https://github.com/payconn/common) is a framework agnostic, multi-gateway payment
processing library for PHP. This package implements common classes required by Payconn.

## Installation

    composer require payconn/nestpay:~1.1.5

## Supported methods
* purchase
* authorize (3D)
* purchaseComplete
* refund

## Basic Usages

### Purchase
```php
$token = new Token('CLIENT_ID', 'USERNAME', 'PASS');
$creditCard = new CreditCard('4355084355084358', '26', '12', '000');
$purchase = new Purchase();
$purchase->setAmount(1);
$purchase->setInstallment(1);
$purchase->setCurrency(Currency::TRY);
$purchase->setCreditCard($creditCard);
$purchase->setTestMode(true);
$response = (AkBank($token))->purchase($purchase);
```

### Authorize
```php
$token = new Token('100100000', 'AKTESTAPI', 'AKBANK01', '123456');
$creditCard = new CreditCard('4355084355084358', '26', '12', '000');
$authorize = new Authorize();
$authorize->setFailureUrl('http://127.0.0.1:8000/failure');
$authorize->setSuccessfulUrl('http://127.0.0.1:8000/successful');
$authorize->setCreditCard($creditCard);
$authorize->setCurrency(Currency::TRY);
$authorize->setAmount(1);
$authorize->setInstallment(1);
$authorize->setTestMode(true);
$response = (new AkBank($token))->authorize($authorize);
```

### Complete
```php
$token = new Token('100100000', 'AKTESTAPI', 'AKBANK01', '123456');
$complete = new Complete();
$complete->setTestMode(true);
$complete->setXid('ifmTW9moVmSL1v4v7CtufhWCcAY=');
$complete->setEci('05');
$complete->setCavv('AAABBCYHAgAAAAARMAcCAAAAAAA=');
$complete->setMd('435508:7D4CC6608E4E5BCFD4DCE2C6A4ED113ED7E916D56E54302CD49012778C2652D6:4285:##100100000');
$complete->setOid('');
$complete->setCurrency(Currency::TRY);
$complete->setInstallment(1);
$complete->setAmount(1);
$response = (new AkBank($token))->complete($complete);
```

### Refund
```php
$token = new Token('100100000', 'AKTESTAPI', 'AKBANK01');
$refund = new Refund();
$refund->setTestMode(true);
$refund->setOrderId('ORDER-19151V8FE19458');
$refund->setAmount('1');
$response = (new AkBank($token))->refund($refund);
```

### Cancel
```php
$token = new Token('100100000', 'AKTESTAPI', 'AKBANK01');
$cancel = new Cancel();
$cancel->setOrderId('ORDER-19149WiYJ13338');
$cancel->setTestMode(true);
$response = (new AkBank($token))->cancel($cancel);
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
