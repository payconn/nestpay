<?php

require_once __DIR__.'/../vendor/autoload.php';

$token = new \Payconn\Nestpay\Token('100100000', 'AKTESTAPI', 'AKBANK01');
$gateway = new \Payconn\Nestpay($token);
$creditCard = new \Payconn\Common\CreditCard('Payconn', '4355084355084358', '26', '12', '000');
$response = $gateway->purchase([
    'creditCard' => $creditCard,
    'amount' => 1,
    'installment' => 1,
    'testMode' => true,
    'currency' => \Payconn\Nestpay\Currency::TRY,
]);
print_r([
    'isSuccessful' => $response->isSuccessful(),
    'message' => $response->getResponseMessage(),
    'code' => $response->getResponseCode(),
    'orderId' => $response->getOrderId(),
]);
