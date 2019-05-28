<?php

namespace Payconn\Nestpay\Request;

use Payconn\Common\AbstractRequest;
use Payconn\Common\HttpClient;
use Payconn\Common\ResponseInterface;
use Payconn\Nestpay\Model\PurchaseComplete;
use Payconn\Nestpay\Response\PurchaseCompleteResponse;
use Payconn\Nestpay\Token;

class PurchaseCompleteRequest extends AbstractRequest
{
    public function send(): ResponseInterface
    {
        /** @var PurchaseComplete $model */
        $model = $this->getModel();
        /** @var Token $token */
        $token = $model->getToken();

        $body = new \SimpleXMLElement('<?xml version="1.0" encoding="ISO-8859-9"?><CC5Request></CC5Request>');
        $body->addChild('Type', 'Auth');
        $body->addChild('Mode', $model->getMode());
        $body->addChild('Name', $token->getUsername());
        $body->addChild('Password', $token->getPassword());
        $body->addChild('ClientId', $token->getClientId());
        $body->addChild('IPAddress', (string) $this->getIpAddress());
        $body->addChild('Total', (string) $model->getAmount());
        $body->addChild('Currency', $model->getCurrency());
        $body->addChild('OrderId', $model->getOid());
        $body->addChild('Number', $model->getMd());
        $body->addChild('Taksit', $model->getInstallment());
        $body->addChild('PayerTxnId', $model->getXid());
        $body->addChild('PayerSecurityLevel', $model->getEci());
        $body->addChild('PayerAuthenticationCode', $model->getCavv());

        /** @var HttpClient $httpClient */
        $httpClient = $this->getHttpClient();
        $response = $httpClient->request('POST', $model->getBaseUrl(), [
            'body' => $body->asXML(),
        ]);

        return new PurchaseCompleteResponse($model, (array) @simplexml_load_string($response->getBody()->getContents()));
    }
}
