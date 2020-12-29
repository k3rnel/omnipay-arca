<?php

namespace Omnipay\Arca\Message;

use Omnipay\Arca\Message\AbstractRequest;

/**
 * Class GetOrderStatusRequest
 * @package Omnipay\Arca\Message
 */
class GetOrderStatusRequest extends AbstractRequest
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

        if ($this->getLanguage()) {
            $data['language'] = $this->getLanguage();
        }


        return $data;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getUrl() . '/getOrderStatus.do';
    }
}