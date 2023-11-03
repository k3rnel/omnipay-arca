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
    const DEPOSITED_ACS = 5;

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
        parent::__construct($request, $data);

        $this->request = $request;
        $this->data = json_decode($data, true);
        $this->headers = $headers;
    }

    /**
     * Is the transaction successful
     *
     * @return bool
     */
    public function isSuccessful() : bool
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
    public function isNotError() : bool
    {
        return $this->getCode() == self::NO_ERROR;
    }

    /**
     * Is the orderStatus completed
     * Full authorization of the order amount
     *
     * @return bool
     */
    public function isCompleted() : bool
    {
        $orderStatus = $this->getOrderStatus();

        return $orderStatus == self::DEPOSITED || $orderStatus == self::DEPOSITED_ACS;
    }

    /**
     * @return bool
     */
    public function isRedirect() : bool
    {
        return isset($this->data['formUrl']) ? true : false;
    }

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
    public function getMessage() : ?string
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
    public function getCode() : ?string
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
    public function getActionCodeDescription() : ?string
    {
        if (isset($this->data['actionCodeDescription'])) {
            return $this->data['actionCodeDescription'];
        }

        return null;
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
