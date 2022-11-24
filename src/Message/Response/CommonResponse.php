<?php

namespace Omnipay\Arca\Message\Response;

/**
 * Arca Response.
 *
 * This is the response class for all Arca requests.
 *
 * @see \Omnipay\Arca\Gateway
 */
class CommonResponse extends AbstractResponse
{
    /**
     * Get response redirect url
     *
     * @return string
     */
    public function getRedirectUrl() : string
    {
        return $this->data['formUrl'];
    }

    /**
     * Get the transaction reference.
     *
     * @return string|null
     */
    public function getTransactionReference() : ?string
    {
        if (isset($this->data['orderId'])) {
            return $this->data['orderId'];
        }

        if (isset($this->orderId)) {
            return $this->orderId;
        }

        return null;
    }

    /**
     * Get the orderNumber reference.
     *
     * @return mixed
     */
    public function getOrderNumberReference() : mixed
    {
        if (isset($this->data['OrderNumber'])) {
            return $this->data['OrderNumber'];
        }

        if (isset($this->data['orderNumber'])) {
            return $this->data['orderNumber'];
        }

        return null;
    }

    /**
     * Get the orderStatus.
     *
     * @return |null
     */
    public function getOrderStatus()
    {
        if (isset($this->data['orderStatus'])) {
            return $this->data['orderStatus'];
        }

        return null;
    }


    /**
     * Get the action code description from the response.
     *
     * @return string|null
     */
    public function getActionCodeDescription() : ?string
    {
        if (isset($this->data['actionCodeDescription'])) {
            return $this->data['actionCodeDescription'];
        }

        return null;
    }

    /**
     * Get binding id of customer.
     *
     * @return string|null
     */
    public function getBindingId() : ?string
    {
        if (isset($this->data['bindingInfo']['bindingId'])) {
            return $this->data['bindingInfo']['bindingId'];
        }
        return null;
    }

    /**
     * Get customer card information like last four digits, expiration date.
     *
     * @return array
     */
    public function getCardAuthInfo() : array
    {
        if (isset($this->data['cardAuthInfo'])) {
            return $this->data['cardAuthInfo'];
        }

        return [];
    }

    /**
     * @return string|null
     */
    public function getRequestId() : ?string
    {
        if (isset($this->headers['Request-Id'])) {
            return $this->headers['Request-Id'][0];
        }

        return null;
    }
}
