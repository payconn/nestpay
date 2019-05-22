<?php

namespace Payconn\Nestpay\Request;

use Payconn\Common\AbstractRequest;

abstract class NestpayRequest extends AbstractRequest
{
    public function getBaseUrl(): string
    {
        if ($this->isTestMode()) {
            return 'https://entegrasyon.asseco-see.com.tr/fim/api';
        }

        return 'https://www.sanalakpos.com/fim/api';
    }

    public function getMode(): string
    {
        if ($this->isTestMode()) {
            return 'T';
        }

        return 'P';
    }
}
