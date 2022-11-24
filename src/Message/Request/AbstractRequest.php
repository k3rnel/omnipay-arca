<?php

namespace Omnipay\Arca\Message\Request;

use Omnipay\Arca\Message\Response\CommonResponse;
use \Omnipay\Common\Message\AbstractRequest as CommonAbstractRequest;
use Omnipay\Common\Message\ResponseInterface;

/**
 * Class AbstractRequest
 *
 * @package Omnipay\Arca\Message
 */
abstract class AbstractRequest extends CommonAbstractRequest
{
    /**
     * Live Endpoint URL.
     *
     * @var string URL
     */
    protected string $endpoint = 'https://ipay.arca.am/payment/rest';

    /**
     * Test Endpoint URL.
     *
     * @var string
     */
    protected string $testEndpoint = 'https://ipaytest.arca.am:8445/payment/rest';

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->getParameter('username');
    }

    /**
     * Set account login.
     *
     * @param $value
     *
     * @return $this
     */
    public function setUsername($value) : AbstractRequest
    {
        return $this->setParameter('username', $value);
    }

    /**
     * @return string
     */
    public function getBindingUsername() : ?string
    {
        return $this->getParameter('bindingUsername');
    }

    /**
     * Set account login.
     *
     * @param $value
     *
     * @return $this
     */
    public function setBindingUsername($value) : AbstractRequest
    {
        return $this->setParameter('bindingUsername', $value);
    }

    /**
     * Set account password.
     *
     * @return mixed
     */
    public function getPassword()
    {
        return $this->getParameter('password');
    }

    /**
     * Set account password.
     *
     * @param $value
     *
     * @return $this
     */
    public function setPassword($value) : AbstractRequest
    {
        return $this->setParameter('password', $value);
    }

    abstract public function getEndpoint();

    /**
     * Get url. Depends on  test mode.
     *
     * @return string
     */
    public function getUrl() : string
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->endpoint;
    }

    /**
     * Get HTTP Method.
     *
     * This is nearly always POST but can be over-ridden in sub classes.
     *
     * @return string
     */
    public function getHttpMethod()
    {
        return 'POST';
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return [];
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->getParameter('language');
    }

    /**
     * Set the request language.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setLanguage($value) : AbstractRequest
    {
        return $this->setParameter('language', $value);
    }

    /**
     * @return mixed
     */
    public function getJsonParams()
    {
        return $this->getParameter('jsonParams');
    }

    /**
     * Set the request jsonParams.
     * Fields of additional information
     *
     * @param string $value
     *
     * @return $this
     */
    public function setJsonParams(string $value) : AbstractRequest
    {
        return $this->setParameter('jsonParams', $value);
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data) : ResponseInterface
    {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        $body = $data ? http_build_query($data, '', '&') : null;

        $httpResponse = $this->httpClient->request($this->getHttpMethod(), $this->getEndpoint(), $headers, $body);

        return $this->createResponse($httpResponse->getBody()->getContents(), $httpResponse->getHeaders());
    }

    /**
     * @param string $data
     * @param array  $headers
     *
     * @return CommonResponse
     */
    protected function createResponse(string $data, array $headers = []) : ResponseInterface
    {
        return $this->response = new CommonResponse($this, $data, $headers);
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData() : array
    {
        $this->validate('username', 'password');

        return [
            'userName' => $this->getUsername(),
            'password' => $this->getPassword(),
        ];
    }
}
