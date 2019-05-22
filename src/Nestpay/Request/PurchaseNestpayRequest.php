<?php

namespace Payconn\Nestpay\Request;

use Payconn\Common\ResponseInterface;
use Payconn\Nestpay\Response\PurchaseResponse;

class PurchaseNestpayRequest extends NestpayRequest
{
    protected $postData = '<?xml version="1.0" encoding="ISO-8859-9"?>
        <CC5Request>
            <Name></Name>
            <Password></Password>
            <ClientId></ClientId>
            <IPAddress></IPAddress>
            <Email></Email>
            <Mode></Mode>
            <OrderId></OrderId>
            <GroupId></GroupId>
            <TransId></TransId>
            <UserId></UserId>
            <Type></Type>
            <Number></Number>
            <Expires></Expires>
            <Cvv2Val></Cvv2Val>
            <Total></Total>
            <Currency></Currency>
            <Taksit></Taksit>
            <BillTo>
                <Name></Name>
                <Street1></Street1>
                <Street2></Street2>
                <Street3></Street3>
                <City></City>
                <StateProv></StateProv>
                <PostalCode></PostalCode>
                <Country></Country>
                <Company></Company>
                <TelVoice></TelVoice>
            </BillTo>
            <ShipTo>
                <Name></Name>
                <Street1></Street1>
                <Street2></Street2>
                <Street3></Street3>
                <City></City>
                <StateProv></StateProv>
                <PostalCode></PostalCode>
                <Country></Country>
            </ShipTo>
            <Extra></Extra>
        </CC5Request>';

    public function getInstallment(): int
    {
        return $this->parameters->get('installment');
    }

    public function getAmount(): float
    {
        return $this->parameters->get('amount');
    }

    public function getCurrency(): string
    {
        return $this->parameters->get('currency');
    }

    public function send(): ResponseInterface
    {
        $body = @simplexml_load_string($this->postData);
        $body->Type = 'Auth';
        $body->Name = $this->getToken()->getUsername();
        $body->Password = $this->getToken()->getPassword();
        $body->ClientId = $this->getToken()->getClientId();
        $body->IPAddress = $this->getIpAddress();
        $body->Mode = $this->getMode();
        $body->Total = $this->getAmount();
        $body->Taksit = $this->getInstallment();
        $body->Currency = $this->getCurrency();
        if ($creditCard = $this->getCreditCard()) {
            $body->Number = $creditCard->getNumber();
            $body->Expires = $creditCard->getExpireMonth().'/'.$creditCard->getExpireYear();
            $body->Cvv2Val = $creditCard->getCvv();
        }
        $response = $this->getHttpClient()->request('POST', $this->getBaseUrl(), [
            'body' => $body->asXML(),
        ]);

        return new PurchaseResponse((array) @simplexml_load_string($response->getBody()->getContents()));
    }
}
