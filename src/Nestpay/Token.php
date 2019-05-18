<?php

namespace Payconn\Nestpay;

use Payconn\Common\TokenInterface;

class Token implements TokenInterface
{
    private $clientId;

    private $username;

    private $password;

    public function __construct(string $clientId, string $username, string $password)
    {
        $this->clientId = $clientId;
        $this->username = $username;
        $this->password = $password;
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
}
