<?php

namespace Omnipay\Arca\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Arca Response.
 *
 * This is the response class for all Arca requests.
 *
 * @see \Omnipay\Arca\Gateway
 */
class Response extends AbstractResponse implements RedirectResponseInterface
{
    const DEPOSITED = 2;
    const NO_ERROR = 0;

    /**
     * Request id
     *
     * @var string URL
     */
    protected $requestId = null;

    /**
     * @var array
     */
    protected $headers = [];

    public function __construct(RequestInterface $request, $data, $headers = [])
    {
        $this->request = $request;
        $this->data = json_decode($data, true);
        $this->headers = $headers;
    }

    /**
     * Is the transaction successful
     *
     * @return bool
     */
    public function isSuccessful()
    {
        if ($this->getOrderStatus()) {
            return $this->isCompleted() && $this->isNotError();
        }

        return $this->isNotError();
    }

    /**
     * Is the response no error
     *
     * @return bool
     */
    public function isNotError()
    {
        return $this->getCode() == self::NO_ERROR;
    }

    /**
     * Is the orderStatus completed
     * Full authorization of the order amount
     *
     * @return bool
     */
    public function isCompleted()
    {
        return $this->getOrderStatus() == self::DEPOSITED;
    }

    /**
     * @return bool
     */
    public function isRedirect()
    {
        return isset($this->data['formUrl']) ? true : false;
    }

    /**
     * Get response redirect url
     *
     * @return string
     */
    public function getRedirectUrl()
    {
        return $this->data['formUrl'];
    }

    /**
     * Get the transaction reference.
     *
     * @return string|null
     */
    public function getTransactionReference()
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
    public function getOrderNumberReference()
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
     * Get the error message from the response.
     *
     * Returns null if the request was successful.
     *
     * @return string|null
     */
    public function getMessage()
    {
        if (isset($this->data['errorMessage'])) {
            return $this->data['errorMessage'];
        }

        if (isset($this->data['ErrorMessage'])) {
            return $this->data['ErrorMessage'];
        }
        return null;
    }

    /**
     * Get the error code from the response.
     *
     * Returns null if the request was successful.
     *
     * @return string|null
     */
    public function getCode()
    {
        if (isset($this->data['errorCode'])) {
            return $this->data['errorCode'];
        }

        if (isset($this->data['ErrorCode'])) {
            return $this->data['ErrorCode'];
        }

        return null;
    }

    /**
     * Get the action code description from the response.
     *
     * @return string|null
     */
    public function getActionCodeDescription()
    {
        if (isset($this->data['actionCodeDescription'])) {
            return $this->data['actionCodeDescription'];
        }

        return null;
    }

    /**
     * @return string|null
     */
    public function getRequestId()
    {
        if (isset($this->headers['Request-Id'])) {
            return $this->headers['Request-Id'][0];
        }

        return null;
    }
}
