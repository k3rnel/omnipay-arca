<?php

namespace Omnipay\Arca\Message\Request;

use Omnipay\Arca\Message\Response\BindingPaymentResponse;

/**
 * @package Omnipay\Arca\Message\Request
 *
 * @method BindingPaymentResponse send
 */
class BindingPaymentRequest extends AbstractBindingAwareRequest
{
    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return array
     */
    public function getData() : array
    {
        $data = parent::getData();

        $data['mdOrder'] = $this->getTransactionReference();
        $data['bindingId'] = $this->getBindingId();
        $data['language'] = $this->getLanguage();
        $data['cvc'] = 615;

        return $data;
    }

    /**
     * @return string
     */
    public function getBindingId() : string
    {
        return $this->getParameter('bindingId');
    }

    /**
     * @param string $value
     *
     * @return \Omnipay\Arca\Message\BindingPaymentRequest
     */
    public function setBindingId(string $value) : BindingPaymentRequest
    {
        return $this->setParameter('bindingId', $value);
    }

    /**
     * @return string
     */
    public function getEndpoint() : string
    {
        return $this->getUrl().'/paymentOrderBinding.do';
    }

    protected function createResponse(string $data, array $headers = []) : BindingPaymentResponse
    {
        return $this->response = new BindingPaymentResponse($this, $data, $headers);
    }
}
