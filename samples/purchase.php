<?php

require_once __DIR__.'/../vendor/autoload.php';

use Payconn\Nestpay;

$gateway = new Nestpay(new Nestpay\Token('123', '123', '123'));
var_dump(get_class($gateway));
