<?php

namespace Payconn\Nestpay\Request;

use Payconn\Common\HttpClient;
use Payconn\Common\ResponseInterface;
use Payconn\Nestpay\Response\VoidResponse;
use Payconn\Nestpay\Token;

class RefundRequest extends NestpayRequest
{
    public function getOrderId(): string
    {
        return $this->parameters->get('orderId');
    }

    public function getAmount(): ?float
    {
        return $this->parameters->get('amount');
    }

    public function send(): ResponseInterface
    {
        /** @var Token $token */
        $token = $this->getToken();

        $body = new \SimpleXMLElement('<?xml version="1.0" encoding="ISO-8859-9"?><CC5Request></CC5Request>');
        $body->addChild('Type', 'Credit');
        $body->addChild('Name', $token->getUsername());
        $body->addChild('Password', $token->getPassword());
        $body->addChild('ClientId', $token->getClientId());
        $body->addChild('OrderId', $this->getOrderId());
        if ($amount = $this->getAmount()) {
            $body->addChild('Total', (string) $this->getAmount());
        }

        /** @var HttpClient $httpClient */
        $httpClient = $this->getHttpClient();
        $response = $httpClient->request('POST', $this->getEndpoint(), [
            'body' => $body->asXML(),
        ]);

        return new VoidResponse((array) @simplexml_load_string($response->getBody()->getContents()));
    }
}
