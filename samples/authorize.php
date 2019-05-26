<?php

require_once __DIR__.'/../vendor/autoload.php';

$token = new \Payconn\Nestpay\Token('100100000', 'AKTESTAPI', 'AKBANK01', '123456');
$gateway = new \Payconn\Nestpay($token);
$creditCard = new \Payconn\Common\CreditCard('Payconn', '4355084355084358', '26', '12', '000');
$response = $gateway->authorize([
    'creditCard' => $creditCard,
    'amount' => 1,
    'testMode' => true,
    'currency' => \Payconn\Nestpay\Currency::TRY,
    'successfulUrl' => 'http://127.0.0.1:8000/successful',
    'failureUrl' => 'http://127.0.0.1:8000/failure',
    'endpoint' => (new \Payconn\Nestpay\Endpoint\Axess(true))->getBaseSecureUrl(),
]);
print_r([
    'isSuccessful' => $response->isSuccessful(),
    'message' => $response->getResponseMessage(),
    'code' => $response->getResponseCode(),
]);
if ($response->isRedirection()) {
    echo $response->getRedirectForm();
}
