<?php

namespace Omnipay\Arca;

use Omnipay\Common\AbstractGateway;


/**
 * Arca Gateway
 *
 * @method \Omnipay\Common\Message\RequestInterface authorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface capture(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface void(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
 * @method \Omnipay\Common\Message\NotificationInterface acceptNotification(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface fetchTransaction(array $options = [])
 */
class Gateway extends AbstractGateway
{
    /**
     * Get name
     *
     * @return string
     */
    public function getName() : string
    {
        return 'Arca';
    }


    /**
     * @return array
     */
    public function getDefaultParameters() : array
    {
        return [
            'username' => '',
            'password' => '',
        ];
    }

    /**
     * Get account login.
     *
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
     * @return $this
     */
    public function setUsername($value) : Gateway
    {
        return $this->setParameter('username', $value);
    }

    /**
     * Get account password.
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
     * @return $this
     */
    public function setPassword($value): Gateway
    {
        return $this->setParameter('password', $value);
    }

    /**
     * Create Purchase Request.
     *
     * @param  array $options
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function purchase(array $options = array()): \Omnipay\Common\Message\AbstractRequest
    {
        return $this->createRequest('\Omnipay\Arca\Message\RegisterRequest', $options);
    }
    
    /**
     * Create Complete Purchase Request.
     *
     * @param  array $options
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function completePurchase(array $options = array()): \Omnipay\Common\Message\AbstractRequest
    {
        return $this->getOrderStatusExtended($options);
    }

    /**
     * Create RegisterPreAuth Request.
     *
     * @param  array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function registerPreAuth(array $parameters = array()): \Omnipay\Common\Message\AbstractRequest
    {
        return $this->createRequest('\Omnipay\Arca\Message\RegisterPreAuthRequest', $parameters);
    }

    /**
     * Create GetOrderStatus Request.
     *
     * @param  array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function getOrderStatus(array $parameters = array()): \Omnipay\Common\Message\AbstractRequest
    {
        return $this->createRequest('\Omnipay\Arca\Message\GetOrderStatusRequest', $parameters);
    }

    /**
     * Create getOrderStatusExtended Request.
     *
     * @param  array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function getOrderStatusExtended(array $parameters = array()): \Omnipay\Common\Message\AbstractRequest
    {
        return $this->createRequest('\Omnipay\Arca\Message\GetOrderStatusExtendedRequest', $parameters);
    }

    /**
     * Create verifyEnrollment Request.
     *
     * @param  array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function verifyEnrollment(array $parameters = array()): \Omnipay\Common\Message\AbstractRequest
    {
        return $this->createRequest('\Omnipay\Arca\Message\VerifyEnrollmentRequest', $parameters);
    }

    /**
     * Create Deposit Request.
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function deposit(array $parameters = array()): \Omnipay\Common\Message\AbstractRequest
    {
        return $this->createRequest('\Omnipay\Arca\Message\DepositRequest', $parameters);
    }

    /**
     * Create Reverse Request.
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function reverse(array $parameters = array()): \Omnipay\Common\Message\AbstractRequest
    {
        return $this->createRequest('\Omnipay\Arca\Message\ReverseRequest', $parameters);
    }

    /**
     * Create Refund Request.
     *
     * @param array $parameters
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function refund(array $parameters = array()): \Omnipay\Common\Message\AbstractRequest
    {
        return $this->createRequest('\Omnipay\Arca\Message\RefundRequest', $parameters);
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement @method \Omnipay\Common\Message\NotificationInterface acceptNotification(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface fetchTransaction(array $options = [])
    }
}
