<?php

namespace Payconn\Nestpay\Request;

use Payconn\Common\AbstractRequest;
use Payconn\Common\HttpClient;
use Payconn\Common\ResponseInterface;
use Payconn\Nestpay\Model\Refund;
use Payconn\Nestpay\Response\RefundResponse;
use Payconn\Nestpay\Token;

class RefundRequest extends AbstractRequest
{
    public function send(): ResponseInterface
    {
        /** @var Refund $model */
        $model = $this->getModel();
        /** @var Token $token */
        $token = $this->getToken();

        $body = new \SimpleXMLElement('<?xml version="1.0" encoding="ISO-8859-9"?><CC5Request></CC5Request>');
        $body->addChild('Type', 'Credit');
        $body->addChild('Name', $token->getUsername());
        $body->addChild('Password', $token->getPassword());
        $body->addChild('ClientId', $token->getClientId());
        $body->addChild('OrderId', $model->getOrderId());
        $body->addChild('Total', (string) $model->getAmount());

        /** @var HttpClient $httpClient */
        $httpClient = $this->getHttpClient();
        $response = $httpClient->request('POST', $model->getBaseUrl(), [
            'body' => $body->asXML(),
        ]);

        return new RefundResponse($model, (array) @simplexml_load_string($response->getBody()->getContents()));
    }
}
