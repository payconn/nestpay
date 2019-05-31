<?php

namespace Payconn\Nestpay\Request;

use Payconn\Common\AbstractRequest;
use Payconn\Common\HttpClient;
use Payconn\Common\ResponseInterface;
use Payconn\Nestpay\Model\Purchase;
use Payconn\Nestpay\Response\PurchaseResponse;
use Payconn\Nestpay\Token;

class PurchaseRequest extends AbstractRequest
{
    public function send(): ResponseInterface
    {
        /** @var Purchase $model */
        $model = $this->getModel();
        /** @var Token $token */
        $token = $this->getToken();

        $body = new \SimpleXMLElement('<?xml version="1.0" encoding="ISO-8859-9"?><CC5Request></CC5Request>');
        $body->addChild('Type', 'Auth');
        $body->addChild('Mode', $model->isTestMode() ? 'T' : 'P');
        $body->addChild('Currency', $model->getCurrency());
        $body->addChild('Name', $token->getUsername());
        $body->addChild('Password', $token->getPassword());
        $body->addChild('ClientId', $token->getClientId());
        $body->addChild('IPAddress', (string) $this->getIpAddress());
        $body->addChild('Total', (string) $model->getAmount());
        $body->addChild('Taksit', (string) $model->getInstallment());
        $body->addChild('Number', $model->getCreditCard()->getNumber());
        $body->addChild('Expires', $model->getCreditCard()->getExpireMonth().'/'.$model->getCreditCard()->getExpireYear());
        $body->addChild('Cvv2Val', $model->getCreditCard()->getCvv());

        /** @var HttpClient $httpClient */
        $httpClient = $this->getHttpClient();
        $response = $httpClient->request('POST', $model->getBaseUrl(), [
            'body' => $body->asXML(),
        ]);

        return new PurchaseResponse($model, (array) @simplexml_load_string($response->getBody()->getContents()));
    }
}
