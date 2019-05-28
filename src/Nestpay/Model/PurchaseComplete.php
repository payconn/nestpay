<?php

namespace Payconn\Nestpay\Model;

class PurchaseComplete extends NestpayModel
{
    private $xid;

    private $eci;

    private $cavv;

    private $md;

    private $oid;

    private $installment;

    public function getXid(): string
    {
        return $this->xid;
    }

    public function setXid(string $xid): self
    {
        $this->xid = $xid;

        return $this;
    }

    public function getEci(): string
    {
        return $this->eci;
    }

    public function setEci(string $eci): self
    {
        $this->eci = $eci;

        return $this;
    }

    public function getCavv(): string
    {
        return $this->cavv;
    }

    public function setCavv(string $cavv): self
    {
        $this->cavv = $cavv;

        return $this;
    }

    public function getMd(): string
    {
        return $this->md;
    }

    public function setMd(string $md): self
    {
        $this->md = $md;

        return $this;
    }

    public function getOid(): string
    {
        return $this->oid;
    }

    public function setOid(string $oid): self
    {
        $this->oid = $oid;

        return $this;
    }

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
