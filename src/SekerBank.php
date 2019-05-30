<?php

namespace Payconn;

use Payconn\Common\ModelInterface;
use Payconn\Nestpay\Model\Purchase;
use Payconn\Nestpay\Model\PurchaseComplete;
use Payconn\Nestpay\Model\Refund;

class SekerBank extends Nestpay
{
    public function overrideBaseUrl(ModelInterface $model): void
    {
        if ($model instanceof Purchase
        || $model instanceof Refund
        || $model instanceof PurchaseComplete) {
            if ($model->isTestMode()) {
                $model->setBaseUrl('https://entegrasyon.asseco-see.com.tr/fim/api');
            } else {
                $model->setBaseUrl('https://sanalpos.sekerbank.com.tr/fim/api');
            }
        } else {
            if ($model->isTestMode()) {
                $model->setBaseUrl('https://entegrasyon.asseco-see.com.tr/fim/est3Dgate');
            } else {
                $model->setBaseUrl('https://sanalpos.sekerbank.com.tr/fim/est3Dgate');
            }
        }
    }
}
