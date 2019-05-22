<?php

namespace Payconn;

use Payconn\Common\AbstractGateway;
use Payconn\Common\ResponseInterface;
use Payconn\Nestpay\Request\PurchaseNestpayRequest;

class Nestpay extends AbstractGateway
{
    public function authorize(array $parameters): ResponseInterface
    {
        // TODO: Implement authorize() method.
    }

    public function authorizeComplete(array $parameters): ResponseInterface
    {
        // TODO: Implement authorizeComplete() method.
    }

    public function purchase(array $parameters): ResponseInterface
    {
        return ($this->createRequest(PurchaseNestpayRequest::class, $parameters))->send();
    }

    public function purchaseComplete(array $parameters): ResponseInterface
    {
        // TODO: Implement purchaseComplete() method.
    }

    public function void(array $parameters): ResponseInterface
    {
        // TODO: Implement void() method.
    }

    public function refund(array $parameters): ResponseInterface
    {
        // TODO: Implement refund() method.
    }
}
