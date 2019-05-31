<?php

namespace Payconn\Nestpay\Request;

use Payconn\Common\AbstractRequest;
use Payconn\Common\HttpClient;
use Payconn\Common\ResponseInterface;
use Payconn\Nestpay\Model\Cancel;
use Payconn\Nestpay\Response\CancelResponse;
use Payconn\Nestpay\Token;

class CancelRequest extends AbstractRequest
{
    public function send(): ResponseInterface
    {
        /** @var Cancel $model */
        $model = $this->getModel();
        /** @var Token $token */
        $token = $this->getToken();

        $body = new \SimpleXMLElement('<?xml version="1.0" encoding="ISO-8859-9"?><CC5Request></CC5Request>');
        $body->addChild('Type', 'Void');
        $body->addChild('Name', $token->getUsername());
        $body->addChild('Password', $token->getPassword());
        $body->addChild('ClientId', $token->getClientId());
        $body->addChild('OrderId', $model->getOrderId());

        /** @var HttpClient $httpClient */
        $httpClient = $this->getHttpClient();
        $response = $httpClient->request('POST', $model->getBaseUrl(), [
            'body' => $body->asXML(),
        ]);

        return new CancelResponse($model, (array) @simplexml_load_string($response->getBody()->getContents()));
    }
}
