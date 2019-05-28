<?php

require_once __DIR__.'/../vendor/autoload.php';

$token = new \Payconn\Nestpay\Token('100100000', 'AKTESTAPI', 'AKBANK01', '123456');
$gateway = new \Payconn\Axess($token);
$purchaseComplete = (new \Payconn\Nestpay\Model\PurchaseComplete($token))
    ->setXid('ifmTW9moVmSL1v4v7CtufhWCcAY=')
    ->setEci('05')
    ->setCavv('AAABBCYHAgAAAAARMAcCAAAAAAA=')
    ->setMd('435508:7D4CC6608E4E5BCFD4DCE2C6A4ED113ED7E916D56E54302CD49012778C2652D6:4285:##100100000')
    ->setOid('')
    ->setCurrency(\Payconn\Nestpay\Currency::TRY)
    ->setInstallment(1)
    ->setAmount(1)
    ->setTestMode(true);
$response = $gateway->purchaseComplete($purchaseComplete);
print_r([
    'isSuccessful' => $response->isSuccessful(),
    'message' => $response->getResponseMessage(),
    'code' => $response->getResponseCode(),
    'orderId' => $response->getOrderId(),
]);
