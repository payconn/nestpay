<?php

namespace Payconn;

use Payconn\Common\ModelInterface;

class World extends Nestpay
{
    public function overrideBaseUrl(ModelInterface $model): void
    {
    }
}
