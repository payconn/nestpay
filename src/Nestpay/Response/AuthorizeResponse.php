<?php

namespace Payconn\Nestpay\Response;

use Payconn\Common\AbstractResponse;

class AuthorizeResponse extends AbstractResponse
{
    public function isSuccessful(): bool
    {
        return true;
    }

    public function getResponseMessage(): string
    {
        return '';
    }

    public function getResponseCode(): string
    {
        return '';
    }

    public function getResponseBody(): array
    {
        return [];
    }

    public function isRedirection(): bool
    {
        return true;
    }

    public function getRedirectForm(): ?string
    {
        return $this->getParameters()->get('content');
    }
}
