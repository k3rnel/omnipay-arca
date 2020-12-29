<?php

namespace Omnipay\Arca\Message;

use Omnipay\Arca\Message\AbstractRequest;

/**
 * Class ReverseRequest
 * @package Omnipay\Arca\Message
 */
class ReverseRequest extends AbstractRequest
{

    /**
     * Prepare data to send
     *
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('transactionId');

        $data = parent::getData();

        $data['orderId'] = $this->getTransactionId();

        return $data;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getUrl() . '/reverse.do';
    }
}