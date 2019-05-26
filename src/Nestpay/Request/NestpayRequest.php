<?php

namespace Payconn\Nestpay\Request;

use Payconn\Common\AbstractRequest;

abstract class NestpayRequest extends AbstractRequest
{
    public function getMode(): string
    {
        if ($this->isTestMode()) {
            return 'T';
        }

        return 'P';
    }
}
