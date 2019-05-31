<?php

namespace Payconn;

use Payconn\Common\BaseUrl;

class IsBank extends Nestpay
{
    public function initialize(): void
    {
        $this->setBaseUrl((new BaseUrl())
            ->setProdUrls('https://sanalpos.isbank.com.tr/fim/api', 'https://sanalpos.isbank.com.tr/fim/est3Dgate')
            ->setTestUrls('https://entegrasyon.asseco-see.com.tr/fim/api', 'https://entegrasyon.asseco-see.com.tr/fim/est3Dgate'));
    }
}
