<?php

namespace Omnipay\Arca\Message\Request;

abstract class AbstractBindingAwareRequest extends AbstractRequest
{
    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return array
     */
    public function getData() : array
    {
        $this->validate('bindingUsername', 'password');

        $data = parent::getData();
//        $data['userName'] = $this->getBindingUsername();

        return $data;
    }

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
