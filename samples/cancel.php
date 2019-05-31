<?php

require_once __DIR__.'/../vendor/autoload.php';

$token = new \Payconn\Nestpay\Token('100100000', 'AKTESTAPI', 'AKBANK01');
$gateway = new \Payconn\AkBank($token);
$cancel = new \Payconn\Nestpay\Model\Cancel();
$cancel->setOrderId('ORDER-19149WiYJ13338');
$cancel->setTestMode(true);
$response = (new \Payconn\AkBank($token))->cancel($cancel);
print_r([
    'isSuccessful' => $response->isSuccessful(),
    'message' => $response->getResponseMessage(),
    'code' => $response->getResponseCode(),
]);
