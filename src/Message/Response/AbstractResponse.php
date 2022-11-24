<?php

namespace Omnipay\Arca\Message\Response;

use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\AbstractResponse as OmnipayAbstractResponse;
use Omnipay\Common\Message\RequestInterface;

abstract class AbstractResponse extends OmnipayAbstractResponse implements RedirectResponseInterface
{
    const NO_ERROR = 0;
    const DEPOSITED = 2;

    /**
     * @var string|null
     */
    protected ?string $requestId = null;

    /**
     * @var array
     */
    protected array $headers = [];

    /**
     * @param \Omnipay\Common\Message\RequestInterface $request
     * @param string                                   $data
     * @param array                                    $headers
     */
    public function __construct(RequestInterface $request, string $data, array $headers = [])
    {
        parent::__construct($request, $data);

        $this->request = $request;
        $this->data = json_decode($data, true);
        $this->headers = $headers;
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

        if (isset($this->data['actionCodeDescription'])) {
            return $this->data['actionCodeDescription'];
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
        return $this->getOrderStatus() == self::DEPOSITED;
    }

    /**
     * @return bool
     */
    public function isRedirect() : bool
    {
        return isset($this->data['formUrl']);
    }
}
