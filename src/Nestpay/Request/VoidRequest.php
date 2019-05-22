<?php

namespace Payconn\Nestpay\Request;

use Payconn\Common\HttpClient;
use Payconn\Common\ResponseInterface;
use Payconn\Nestpay\Response\VoidResponse;
use Payconn\Nestpay\Token;

class VoidRequest extends NestpayRequest
{
    public function getOrderId(): string
    {
        return $this->parameters->get('orderId');
    }

    public function send(): ResponseInterface
    {
        /** @var Token $token */
        $token = $this->getToken();

        $body = new \SimpleXMLElement('<?xml version="1.0" encoding="ISO-8859-9"?><CC5Request></CC5Request>');
        $body->addChild('Type', 'Void');
        $body->addChild('Name', $token->getUsername());
        $body->addChild('Password', $token->getPassword());
        $body->addChild('ClientId', $token->getClientId());
        $body->addChild('OrderId', $this->getOrderId());

        /** @var HttpClient $httpClient */
        $httpClient = $this->getHttpClient();
        $response = $httpClient->request('POST', $this->getBaseUrl(), [
            'body' => $body->asXML(),
        ]);

        return new VoidResponse((array) @simplexml_load_string($response->getBody()->getContents()));
    }
}