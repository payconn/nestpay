<?php

namespace Payconn;

use Payconn\Common\ModelInterface;

class Cardfinans extends Nestpay
{
    public function overrideBaseUrl(ModelInterface $model): void
    {
    }
}
