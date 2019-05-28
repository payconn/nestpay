<?php

namespace Payconn\Nestpay\Model;

class Purchase extends NestpayModel
{
    private $installment;

    public function getInstallment(): int
    {
        return $this->installment;
    }

    public function setInstallment(int $installment): self
    {
        $this->installment = $installment;

        return $this;
    }
}
