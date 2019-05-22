<?php

require_once __DIR__.'/../vendor/autoload.php';

use Payconn\Nestpay;

$gateway = new Nestpay(new Nestpay\Token('100100000', 'AKTESTAPI', 'AKBANK01'));
$response = $gateway->purchase([
    'creditCard' => new \Payconn\Common\CreditCard('Payconn', '4355084355084358', '26', '12', '000'),
    'amount' => 1,
    'installment' => 1,
    'testMode' => true,
    'currency' => Nestpay\Currency::TRY,
]);
print_r([
    'isSuccessful' => $response->isSuccessful(),
    'message' => $response->getResponseMessage(),
    'code' => $response->getResponseCode(),
    'orderId' => $response->getOrderId(),
]);
