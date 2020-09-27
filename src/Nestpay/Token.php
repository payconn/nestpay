<?php

namespace Payconn\Nestpay;

use Payconn\Common\TokenInterface;

class Token implements TokenInterface
{
    private $clientId;

    private $username;

    private $password;

    private $storeKey;

    public function __construct(string $clientId, string $username, string $password, string $storeKey = null)
    {
        $this->clientId = $clientId;
        $this->username = $username;
        $this->password = $password;
        $this->storeKey = $storeKey;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getStoreKey(): ?string
    {
        return $this->storeKey;
    }
}
