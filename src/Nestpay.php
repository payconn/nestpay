<?php

namespace Payconn;

use Payconn\Common\AbstractGateway;
use Payconn\Common\Model\AuthorizeInterface;
use Payconn\Common\Model\CancelInterface;
use Payconn\Common\Model\CompleteInterface;
use Payconn\Common\Model\PurchaseInterface;
use Payconn\Common\Model\RefundInterface;
use Payconn\Common\ResponseInterface;
use Payconn\Nestpay\Request\AuthorizeRequest;
use Payconn\Nestpay\Request\CancelRequest;
use Payconn\Nestpay\Request\CompleteRequest;
use Payconn\Nestpay\Request\PurchaseRequest;
use Payconn\Nestpay\Request\RefundRequest;

abstract class Nestpay extends AbstractGateway
{
    public function purchase(PurchaseInterface $purchase): ResponseInterface
    {
        return $this->createRequest(PurchaseRequest::class, $purchase);
    }

    public function authorize(AuthorizeInterface $authorize): ResponseInterface
    {
        return $this->createRequest(AuthorizeRequest::class, $authorize);
    }

    public function complete(CompleteInterface $complete): ResponseInterface
    {
        return $this->createRequest(CompleteRequest::class, $complete);
    }

    public function refund(RefundInterface $refund): ResponseInterface
    {
        return $this->createRequest(RefundRequest::class, $refund);
    }

    public function cancel(CancelInterface $cancel): ResponseInterface
    {
        return $this->createRequest(CancelRequest::class, $cancel);
    }
}
