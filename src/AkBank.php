<?php

namespace Payconn;

use Payconn\Common\BaseUrl;

class AkBank extends Nestpay
{
    public function initialize(): void
    {
        $this->setBaseUrl((new BaseUrl())
            ->setProdUrls('https://www.sanalakpos.com/fim/api', 'https://www.sanalakpos.com/fim/est3Dgate')
            ->setTestUrls('https://entegrasyon.asseco-see.com.tr/fim/api', 'https://entegrasyon.asseco-see.com.tr/fim/est3Dgate'));
    }
}
