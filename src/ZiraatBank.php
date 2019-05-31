<?php

namespace Payconn;

use Payconn\Common\BaseUrl;

class ZiraatBank extends Nestpay
{
    public function initialize(): void
    {
        $this->setBaseUrl((new BaseUrl())
            ->setProdUrls('https://sanalpos2.ziraatbank.com.tr/fim/api', 'https://sanalpos2.ziraatbank.com.tr/fim/est3Dgate')
            ->setTestUrls('https://entegrasyon.asseco-see.com.tr/fim/api', 'https://entegrasyon.asseco-see.com.tr/fim/est3Dgate'));
    }
}
