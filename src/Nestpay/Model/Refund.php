<?php

namespace Payconn\Nestpay\Model;

class Refund extends NestpayModel
{
    private $orderId;

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function setOrderId(string $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }
}
