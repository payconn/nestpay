<?php

namespace Payconn\Nestpay\Model;

use Payconn\Common\AbstractModel;
use Payconn\Common\Model\CancelInterface;
use Payconn\Common\Traits\OrderId;

class Cancel extends AbstractModel implements CancelInterface
{
    use OrderId;
}
