<?php

namespace Payconn\Nestpay\Model;

use Payconn\Common\AbstractModel;
use Payconn\Common\Model\PurchaseInterface;
use Payconn\Common\Traits\Amount;
use Payconn\Common\Traits\CreditCard;
use Payconn\Common\Traits\Currency;
use Payconn\Common\Traits\Installment;

class Purchase extends AbstractModel implements PurchaseInterface
{
    use CreditCard;
    use Amount;
    use Installment;
    use Currency;
}
