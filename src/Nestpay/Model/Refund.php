<?php

namespace Payconn\Nestpay\Model;

use Payconn\Common\AbstractModel;
use Payconn\Common\Model\RefundInterface;
use Payconn\Common\Traits\Amount;
use Payconn\Common\Traits\OrderId;

class Refund extends AbstractModel implements RefundInterface
{
    use OrderId;
    use Amount;
}
