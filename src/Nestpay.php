<?php

namespace Payconn;

use Payconn\Common\AbstractGateway;
use Payconn\Common\ModelInterface;
use Payconn\Common\ResponseInterface;
use Payconn\Nestpay\Request\AuthorizeRequest;
use Payconn\Nestpay\Request\PurchaseCompleteRequest;
use Payconn\Nestpay\Request\PurchaseRequest;
use Payconn\Nestpay\Request\RefundRequest;

abstract class Nestpay extends AbstractGateway
{
    public function authorize(ModelInterface $model): ResponseInterface
    {
        $this->overrideBaseUrl($model);

        return ($this->createRequest(AuthorizeRequest::class, $model))->send();
    }

    public function purchase(ModelInterface $model): ResponseInterface
    {
        $this->overrideBaseUrl($model);

        return ($this->createRequest(PurchaseRequest::class, $model))->send();
    }

    public function purchaseComplete(ModelInterface $model): ResponseInterface
    {
        $this->overrideBaseUrl($model);

        return ($this->createRequest(PurchaseCompleteRequest::class, $model))->send();
    }

    public function refund(ModelInterface $model): ResponseInterface
    {
        $this->overrideBaseUrl($model);

        return ($this->createRequest(RefundRequest::class, $model))->send();
    }

    public function authorizeComplete(ModelInterface $model): ResponseInterface
    {
        // TODO: Implement authorizeComplete() method.
    }
}
