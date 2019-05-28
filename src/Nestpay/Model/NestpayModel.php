<?php

namespace Payconn\Nestpay\Model;

use Payconn\Common\AbstractModel;

class NestpayModel extends AbstractModel
{
    public function getMode(): string
    {
        if ($this->isTestMode()) {
            return 'T';
        }

        return 'P';
    }
}
