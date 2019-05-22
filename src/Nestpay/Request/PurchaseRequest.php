<?php

namespace Payconn\Nestpay\Request;

use Payconn\Common\ResponseInterface;
use Payconn\Nestpay\Response\PurchaseResponse;

class PurchaseRequest extends NestpayRequest
{
    public function getInstallment(): int
    {
        return $this->parameters->get('installment');
    }

    public function getAmount(): float
    {
        return $this->parameters->get('amount');
    }

    public function getCurrency(): string
    {
        return $this->parameters->get('currency');
    }

    public function send(): ResponseInterface
    {
        $body = new \SimpleXMLElement('<?xml version="1.0" encoding="ISO-8859-9"?><CC5Request></CC5Request>');
        $body->addChild('Type', 'Auth');
        $body->addChild('Mode', $this->getMode());
        $body->addChild('Currency', $this->getCurrency());
        $body->addChild('Name', $this->getToken()->getUsername());
        $body->addChild('Password', $this->getToken()->getPassword());
        $body->addChild('ClientId', $this->getToken()->getClientId());
        $body->addChild('IPAddress', (string)$this->getIpAddress());
        $body->addChild('Total', (float)$this->getAmount());
        $body->addChild('Taksit', (int)$this->getInstallment());

        if ($creditCard = $this->getCreditCard()) {
            $body->addChild('Number', $creditCard->getNumber());
            $body->addChild('Expires', $creditCard->getExpireMonth().'/'.$creditCard->getExpireYear());
            $body->addChild('Cvv2Val', $creditCard->getCvv());
        }

        $response = $this->getHttpClient()->request('POST', $this->getBaseUrl(), [
            'body' => $body->asXML(),
        ]);

        return new PurchaseResponse((array) @simplexml_load_string($response->getBody()->getContents()));
    }
}
