<?php

namespace Payconn\Nestpay\Request;

use Payconn\Common\AbstractRequest;
use Payconn\Common\HttpClient;
use Payconn\Common\ResponseInterface;
use Payconn\Nestpay\Model\Complete;
use Payconn\Nestpay\Response\CompleteResponse;
use Payconn\Nestpay\Token;

class CompleteRequest extends AbstractRequest
{
    public function send(): ResponseInterface
    {
        /** @var Complete $model */
        $model = $this->getModel();
        /** @var Token $token */
        $token = $this->getToken();

        $body = new \SimpleXMLElement('<?xml version="1.0" encoding="ISO-8859-9"?><CC5Request></CC5Request>');
        $body->addChild('Type', 'Auth');
        $body->addChild('Mode', $model->isTestMode() ? 'T' : 'P');
        $body->addChild('Name', $token->getUsername());
        $body->addChild('Password', $token->getPassword());
        $body->addChild('ClientId', $token->getClientId());
        $body->addChild('IPAddress', (string) $this->getIpAddress());
        $body->addChild('Total', (string) $model->getAmount());
        $body->addChild('Currency', $model->getCurrency());
        $body->addChild('OrderId', $model->getReturnParams()->get('oid'));
        $body->addChild('Number', $model->getReturnParams()->get('md'));
        $body->addChild('Taksit', (string) $model->getInstallment());
        $body->addChild('PayerTxnId', $model->getReturnParams()->get('xid'));
        $body->addChild('PayerSecurityLevel', $model->getReturnParams()->get('eci'));
        $body->addChild('PayerAuthenticationCode', $model->getReturnParams()->get('cavv'));

        /** @var HttpClient $httpClient */
        $httpClient = $this->getHttpClient();
        $response = $httpClient->request('POST', $model->getBaseUrl(), [
            'body' => $body->asXML(),
        ]);

        return new CompleteResponse($model, (array) @simplexml_load_string($response->getBody()->getContents()));
    }
}
