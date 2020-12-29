<?php

namespace Omnipay\Arca\Message;

use Omnipay\Arca\Message\AbstractRequest;

/**
 * Class RegisterRequest
 * @package Omnipay\Arca\Message
 */
class RegisterRequest extends AbstractRequest
{
    /**
     * @return mixed
     */
    public function getPageView()
    {
        return $this->getParameter('pageView');
    }

    /**
     * Set the request PageView.
     * << MOBILE or DESKTOP >>
     *
     * @param string $value
     *
     * @return $this
     */
    public function setPageView($value)
    {
        return $this->setParameter('pageView', $value);
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->getParameter('clientId');
    }

    /**
     * Set the request clientId.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setClientId($value)
    {
        return $this->setParameter('clientId', $value);
    }

    /**
     * @return mixed
     */
    public function getTimeout()
    {
        return $this->getParameter('sessionTimeoutSecs');
    }

    /**
     * Set the request sessionTimeoutSecs.
     *
     * @param string $value < 1200 Second (20minute)
     *
     * @return $this
     */
    public function setTimeout($value)
    {
        return $this->setParameter('sessionTimeoutSecs', $value);
    }

    /**
     * Prepare data to send
     *
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('transactionId', 'amount', 'returnUrl');

        $data = parent::getData();

        $data['orderNumber'] = $this->getTransactionId();
        $data['amount'] = $this->getAmountInteger();
        $data['returnUrl'] = $this->getReturnUrl();

        if ($this->getCurrency()) {
            $data['currency'] = $this->getCurrency();
        }

        if ($this->getDescription()) {
            $data['description'] = $this->getDescription();
        }

        if ($this->getLanguage()) {
            $data['language'] = $this->getLanguage();
        }

        if ($this->getPageView()) {
            $data['pageView'] = $this->getPageView();
        }

        if ($this->getClientId()) {
            $data['clientId'] = $this->getClientId();
        }

        if ($this->getJsonParams()) {
            $data['jsonParams'] = $this->getJsonParams();
        }

        if ($this->getTimeout()) {
            $data['sessionTimeoutSecs'] = $this->getTimeout();
        }

        return $data;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getUrl() . '/register.do';
    }
}