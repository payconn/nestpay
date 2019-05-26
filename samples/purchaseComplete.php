<?php

require_once __DIR__.'/../vendor/autoload.php';

$token = new \Payconn\Nestpay\Token('100100000', 'AKTESTAPI', 'AKBANK01', '123456');
$gateway = new \Payconn\Nestpay($token);
$response = $gateway->purchaseComplete([
    'amount' => '1',
    'xid' => 'ifmTW9moVmSL1v4v7CtufhWCcAY=',
    'eci' => '05',
    'cavv' => 'AAABBCYHAgAAAAARMAcCAAAAAAA=',
    'md' => '435508:7D4CC6608E4E5BCFD4DCE2C6A4ED113ED7E916D56E54302CD49012778C2652D6:4285:##100100000',
    'oid' => '',
    'Currency' => '949',
    'clientIp' => '82.222.220.194',
    'installment' => '1',
    'testMode' => true,
    'endpoint' => (new \Payconn\Nestpay\Endpoint\Axess(true))->getBaseUrl(),
]);
print_r([
    'isSuccessful' => $response->isSuccessful(),
    'message' => $response->getResponseMessage(),
    'code' => $response->getResponseCode(),
    'orderId' => $response->getOrderId(),
]);
