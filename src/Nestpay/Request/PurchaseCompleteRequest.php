<?php

namespace Payconn\Nestpay\Request;

use Payconn\Common\HttpClient;
use Payconn\Common\ResponseInterface;
use Payconn\Nestpay\Response\PurchaseCompleteResponse;
use Payconn\Nestpay\Token;

class PurchaseCompleteRequest extends NestpayRequest
{
    public function getAmount(): string
    {
        return $this->parameters->get('amount');
    }

    public function getXid(): string
    {
        return $this->parameters->get('xid');
    }

    public function getEci(): string
    {
        return $this->parameters->get('eci');
    }

    public function getCavv(): string
    {
        return $this->parameters->get('cavv');
    }

    public function getMd(): string
    {
        return $this->parameters->get('md');
    }

    public function getOrderId(): string
    {
        return $this->parameters->get('oid');
    }

    public function getCurrency(): string
    {
        return $this->parameters->get('Currency');
    }

    public function getIpAddress(): ?string
    {
        return $this->parameters->get('clientIp');
    }

    public function getInstallment(): string
    {
        return $this->parameters->get('installment');
    }

    public function send(): ResponseInterface
    {
        /** @var Token $token */
        $token = $this->getToken();

        $body = new \SimpleXMLElement('<?xml version="1.0" encoding="ISO-8859-9"?><CC5Request></CC5Request>');
        $body->addChild('Type', 'Auth');
        $body->addChild('Mode', $this->getMode());
        $body->addChild('Name', $token->getUsername());
        $body->addChild('Password', $token->getPassword());
        $body->addChild('ClientId', $token->getClientId());
        $body->addChild('IPAddress', (string) $this->getIpAddress());
        $body->addChild('Total', (string) $this->getAmount());
        $body->addChild('Currency', $this->getCurrency());
        $body->addChild('OrderId', $this->getOrderId());
        $body->addChild('Number', $this->getMd());
        $body->addChild('Taksit', $this->getInstallment());
        $body->addChild('PayerTxnId', $this->getXid());
        $body->addChild('PayerSecurityLevel', $this->getEci());
        $body->addChild('PayerAuthenticationCode', $this->getCavv());

        /** @var HttpClient $httpClient */
        $httpClient = $this->getHttpClient();
        $response = $httpClient->request('POST', $this->getEndpoint(), [
            'body' => $body->asXML(),
        ]);

        return new PurchaseCompleteResponse((array) @simplexml_load_string($response->getBody()->getContents()));
    }
}
