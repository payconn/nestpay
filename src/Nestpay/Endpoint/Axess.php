<?php

namespace Payconn\Nestpay\Endpoint;

use Payconn\Common\AbstractEndpoint;

class Axess extends AbstractEndpoint
{
    public function getBaseUrl(): string
    {
        if ($this->testMode) {
            return 'https://entegrasyon.asseco-see.com.tr/fim/api';
        }

        return 'https://www.sanalakpos.com/fim/api';
    }

    public function getBaseSecureUrl(): string
    {
        if ($this->testMode) {
            return 'https://entegrasyon.asseco-see.com.tr/fim/est3Dgate';
        }

        return 'https://www.sanalakpos.com/fim/est3Dgate';
    }
}
