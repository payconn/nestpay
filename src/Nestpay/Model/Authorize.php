<?php

namespace Payconn\Nestpay\Model;

use Payconn\Common\AbstractModel;
use Payconn\Common\Model\AuthorizeInterface;
use Payconn\Common\Traits\Amount;
use Payconn\Common\Traits\CreditCard;
use Payconn\Common\Traits\Currency;
use Payconn\Common\Traits\Installment;
use Payconn\Common\Traits\OrderId;
use Payconn\Common\Traits\ReturnUrl;

class Authorize extends AbstractModel implements AuthorizeInterface
{
    use CreditCard;
    use Amount;
    use Installment;
    use ReturnUrl;
    use Currency;
    use OrderId;
}
