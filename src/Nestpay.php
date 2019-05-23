<?php

namespace Payconn;

use Payconn\Common\AbstractGateway;
use Payconn\Common\ResponseInterface;
use Payconn\Nestpay\Request\PurchaseRequest;
use Payconn\Nestpay\Request\RefundRequest;
use Payconn\Nestpay\Request\VoidRequest;

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
        return ($this->createRequest(PurchaseRequest::class, $parameters))->send();
    }

    public function purchaseComplete(array $parameters): ResponseInterface
    {
        // TODO: Implement purchaseComplete() method.
    }

    public function void(array $parameters): ResponseInterface
    {
        return ($this->createRequest(VoidRequest::class, $parameters))->send();
    }

    public function refund(array $parameters): ResponseInterface
    {
        return ($this->createRequest(RefundRequest::class, $parameters))->send();
    }
}
