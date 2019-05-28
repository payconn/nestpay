<?php

namespace Payconn;

use Payconn\Common\ModelInterface;

class Bonus extends Nestpay
{
    public function overrideBaseUrl(ModelInterface $model): void
    {
    }
}
