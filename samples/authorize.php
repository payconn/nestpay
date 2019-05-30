<?php

require_once __DIR__.'/../vendor/autoload.php';

$token = new \Payconn\Nestpay\Token('100100000', 'AKTESTAPI', 'AKBANK01', '123456');
$gateway = new \Payconn\AkBank($token);
$creditCard = new \Payconn\Common\CreditCard('4355084355084358', '26', '12', '000');
$authorize = (new \Payconn\Nestpay\Model\Authorize($token))
    ->setFailureUrl('http://127.0.0.1:8000/failure')
    ->setSuccessfulUrl('http://127.0.0.1:8000/successful')
    ->setCreditCard($creditCard)
    ->setCurrency(\Payconn\Nestpay\Currency::TRY)
    ->setAmount(1)
    ->setInstallment(1)
    ->setTestMode(true);
$response = $gateway->authorize($authorize);
print_r([
    'isSuccessful' => $response->isSuccessful(),
    'message' => $response->getResponseMessage(),
    'code' => $response->getResponseCode(),
]);
if ($response->isRedirection()) {
    echo $response->getRedirectForm();
}
