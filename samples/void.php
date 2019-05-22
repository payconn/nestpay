<?php

require_once __DIR__.'/../vendor/autoload.php';

use Payconn\Nestpay;

$gateway = new Nestpay(new Nestpay\Token('100100000', 'AKTESTAPI', 'AKBANK01'));
$response = $gateway->void([
    'orderId' => 'ORDER-19142WBDD17190',
    'testMode' => true,
]);
print_r([
    'isSuccessful' => $response->isSuccessful(),
    'message' => $response->getResponseMessage(),
    'code' => $response->getResponseCode(),
]);
