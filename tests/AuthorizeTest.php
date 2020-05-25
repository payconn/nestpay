<?php

namespace Payconn\Nestpay\Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Payconn\Common\HttpClient;
use PHPUnit\Framework\TestCase;

class AuthorizeTest extends TestCase
{
    public function testSuccessful()
    {
        $response = new Response(200, [], 'TEST_CONTENT');
        $mock = new MockHandler([
            $response,
        ]);
        $handler = HandlerStack::create($mock);
        $client = new HttpClient(['handler' => $handler]);

        // authorize
        $token = new \Payconn\Nestpay\Token('100100000', 'AKTESTAPI', 'AKBANK01');
        $creditCard = new \Payconn\Common\CreditCard('4355084355084358', '26', '12', '000');
        $authorize = new \Payconn\Nestpay\Model\Authorize();
        $authorize->setTestMode(true);
        $authorize->setSuccessfulUrl('http://127.0.0.1:8000/successful');
        $authorize->setFailureUrl('http://127.0.0.1:8000/failure');
        $authorize->setCreditCard($creditCard);
        $authorize->setAmount(1);
        $authorize->generateOrderId();
        $authorize->setCurrency(\Payconn\Nestpay\Currency::TRY);
        $response = (new \Payconn\AkBank($token, $client))->authorize($authorize);
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('TEST_CONTENT', $response->getRedirectForm());
    }
}
