<?php

namespace Payconn;

use Payconn\Common\BaseUrl;

class FinansBank extends Nestpay
{
    public function initialize(): void
    {
        $this->setBaseUrl((new BaseUrl())
            ->setProdUrls('https://www.fbwebpos.com/fim/api', 'https://www.fbwebpos.com/fim/est3Dgate')
            ->setTestUrls('https://entegrasyon.asseco-see.com.tr/fim/api', 'https://entegrasyon.asseco-see.com.tr/fim/est3Dgate'));
    }
}
