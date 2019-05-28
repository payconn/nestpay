<?php

namespace Payconn\Nestpay\Model;

class Authorize extends NestpayModel
{
    private $installment;

    private $successfulUrl;

    private $failureUrl;

    public function getInstallment(): int
    {
        return $this->installment;
    }

    public function setInstallment(int $installment): self
    {
        $this->installment = $installment;

        return $this;
    }

    public function getSuccessfulUrl(): string
    {
        return $this->successfulUrl;
    }

    public function setSuccessfulUrl($successfulUrl): self
    {
        $this->successfulUrl = $successfulUrl;

        return $this;
    }

    public function getFailureUrl(): string
    {
        return $this->failureUrl;
    }

    public function setFailureUrl($failureUrl): self
    {
        $this->failureUrl = $failureUrl;

        return $this;
    }
}
