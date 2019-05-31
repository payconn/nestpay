<?php

namespace Payconn\Nestpay\Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Payconn\Common\HttpClient;
use PHPUnit\Framework\TestCase;

class RefundTest extends TestCase
{
    public function testFailure()
    {
        $response = new Response(200, [], '<?xml version="1.0" encoding="UTF-8"?>
            <CC5Response>
               <Response>Decline</Response>
               <ErrMsg />
            </CC5Response>');
        $mock = new MockHandler([
            $response,
        ]);
        $handler = HandlerStack::create($mock);
        $client = new HttpClient(['handler' => $handler]);

        // purchase
        $token = new \Payconn\Nestpay\Token('100100000', 'AKTESTAPI', 'AKBANK01');
        $refund = new \Payconn\Nestpay\Model\Refund();
        $refund->setTestMode(true);
        $refund->setAmount(1);
        $refund->setOrderId('ORDER123');
        $response = (new \Payconn\AkBank($token, $client))->refund($refund);
        $this->assertFalse($response->isSuccessful());
    }

    public function testSuccessful()
    {
        $response = new Response(200, [], '<?xml version="1.0" encoding="UTF-8"?>
            <CC5Response>
               <Response>Approved</Response>
               <ErrMsg />
            </CC5Response>');
        $mock = new MockHandler([
            $response,
        ]);
        $handler = HandlerStack::create($mock);
        $client = new HttpClient(['handler' => $handler]);

        // purchase
        $token = new \Payconn\Nestpay\Token('100100000', 'AKTESTAPI', 'AKBANK01');
        $refund = new \Payconn\Nestpay\Model\Refund();
        $refund->setTestMode(true);
        $refund->setAmount(1);
        $refund->setOrderId('ORDER123');
        $response = (new \Payconn\AkBank($token, $client))->refund($refund);
        $this->assertTrue($response->isSuccessful());
    }
}
