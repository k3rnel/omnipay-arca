<?php

namespace Omnipay\Arca\Message\Request;

/**
 * Class VerifyEnrollmentRequest
 * @package Omnipay\Arca\Message
 */
class VerifyEnrollmentRequest extends AbstractRequest
{
    /**
     * @return mixed
     */
    public function getPan()
    {
        return $this->getParameter('pan');
    }

    /**
     * Set the request pan.
     *
     * @param $value
     * @return $this
     */
    public function setPan($value) : VerifyEnrollmentRequest
    {
        return $this->setParameter('pan', $value);
    }

    /**
     * Prepare data to send
     *
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData() : array
    {
        $this->validate('pan');

        $data = parent::getData();

        $data['pan'] = $this->getPan();

        return $data;
    }

    /**
     * @return string
     */
    public function getEndpoint() : string
    {
        return $this->getUrl() . '/verifyEnrollment.do';
    }
}
