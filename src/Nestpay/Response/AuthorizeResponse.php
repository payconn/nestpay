<?php

namespace Payconn\Nestpay\Response;

use Payconn\Common\AbstractResponse;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Forms;

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

    public function redirect(): void
    {
        $form = (Forms::createFormFactory())->createBuilder(FormType::class, null, [
            'action' => $this->getParameters()->get('endpoint'),
            'method' => 'POST',
        ])
        ->add('rnd', HiddenType::class)
        ->add('hash', HiddenType::class)
        ->add('storetype', HiddenType::class)
        ->add('lang', HiddenType::class)
        ->add('oid', HiddenType::class)
        ->add('pan', HiddenType::class)
        ->add('cv2', HiddenType::class)
        ->add('Ecom_Payment_Card_ExpDate_Year', HiddenType::class)
        ->add('Ecom_Payment_Card_ExpDate_Month', HiddenType::class)
        ->add('cardType', HiddenType::class)
        ->add('clientid', HiddenType::class)
        ->add('amount', HiddenType::class)
        ->add('okUrl', HiddenType::class)
        ->add('failUrl', HiddenType::class)
        ->getForm();

        $form->submit($this->getParameters());
    }
}
