<?php

namespace Omnipay\Arca\Message\Request;

abstract class AbstractBindingAwareRequest extends AbstractRequest
{
    public function getBindingId() : string
    {
        return $this->getParameter('bindingId');
    }

    /**
     * @param string $value
     *
     * @return \Omnipay\Arca\Message\Request\AbstractBindingAwareRequest
     */
    public function setBindingId(string $value) : AbstractBindingAwareRequest
    {
        return $this->setParameter('bindingId', $value);
    }



    /**
     * Get the request clientId.
     *
     * @return string|int
     */
    public function getClientId(): string
    {
        return $this->getParameter('clientId');
    }

    /**
     * Set the request clientId.
     *
     * @param string|int $value
     *
     * @return \Omnipay\Arca\Message\Request\AbstractBindingAwareRequest
     */
    public function setClientId(string|int $value) : AbstractBindingAwareRequest
    {
        return $this->setParameter('clientId', $value);
    }
}
