<?php

namespace Payconn\Nestpay\Request;

use Payconn\Common\AbstractRequest;
use Payconn\Common\ResponseInterface;
use Payconn\Nestpay\Response\AuthorizeResponse;
use Payconn\Nestpay\Token;

class AuthorizeRequest extends AbstractRequest
{
    public function getAmount(): float
    {
        return $this->parameters->get('amount');
    }

    public function getInstallment(): int
    {
        return $this->parameters->get('installment');
    }

    public function getCurrency(): string
    {
        return $this->parameters->get('currency');
    }

    public function getSuccessfulUrl(): string
    {
        return $this->parameters->get('successfulUrl');
    }

    public function getFailureUrl(): string
    {
        return $this->parameters->get('failureUrl');
    }

    public function getCardType(): string
    {
        return $this->parameters->get('cardType');
    }

    public function send(): ResponseInterface
    {
        /** @var Token $token */
        $token = $this->getToken();

        $rnd = microtime();
        $hash = base64_encode(pack('H*', sha1($token->getClientId().''.$this->getAmount().$this->getSuccessfulUrl().$this->getFailureUrl().$rnd.$token->getStoreKey())));

        return new AuthorizeResponse([
            'rnd' => $rnd,
            'hash' => $hash,
            'storetype' => '3d',
            'lang' => 'tr',
            'oid' => '',
            'pan' => $this->getCreditCard()->getNumber(),
            'cv2' => $this->getCreditCard()->getCvv(),
            'Ecom_Payment_Card_ExpDate_Year' => $this->getCreditCard()->getExpireYear(),
            'Ecom_Payment_Card_ExpDate_Month' => $this->getCreditCard()->getExpireMonth(),
            'cardType' => $this->getCreditCard(),
            'clientid' => $token->getClientId(),
            'amount' => $this->getAmount(),
            'okUrl' => $this->getSuccessfulUrl(),
            'failUrl' => $this->getFailureUrl(),
        ]);
    }
}
