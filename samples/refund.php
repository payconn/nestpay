<?php

require_once __DIR__.'/../vendor/autoload.php';

$token = new \Payconn\Nestpay\Token('100100000', 'AKTESTAPI', 'AKBANK01');
$gateway = new \Payconn\Axess($token);
$refund = (new \Payconn\Nestpay\Model\Refund($token))
    ->setOrderId('ORDER-19148XhCD19737')
    ->setTestMode(true)
    ->setAmount(1);
$response = $gateway->refund($refund);
print_r([
    'isSuccessful' => $response->isSuccessful(),
    'message' => $response->getResponseMessage(),
    'code' => $response->getResponseCode(),
]);
