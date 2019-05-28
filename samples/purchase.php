<?php

require_once __DIR__.'/../vendor/autoload.php';

$token = new \Payconn\Nestpay\Token('100100000', 'AKTESTAPI', 'AKBANK01');
$gateway = new \Payconn\Axess($token);
$creditCard = new \Payconn\Common\CreditCard('4355084355084358', '26', '12', '000');
$purchase = (new \Payconn\Nestpay\Model\Purchase($token))
    ->setInstallment(1)
    ->setAmount(1)
    ->setCurrency(\Payconn\Nestpay\Currency::TRY)
    ->setCreditCard($creditCard)
    ->setTestMode(true);
$response = $gateway->purchase($purchase);
print_r([
    'isSuccessful' => $response->isSuccessful(),
    'message' => $response->getResponseMessage(),
    'code' => $response->getResponseCode(),
    'orderId' => $response->getOrderId(),
]);
