<?php

namespace Omnipay\Arca\Message\Request;

/**
 * Class DepositRequest
 * @package Omnipay\Arca\Message
 */
class DepositRequest extends AbstractRequest
{
    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('transactionId', 'amount');

        $data = [];

        $data['orderId'] = $this->getTransactionId();

        if ($this->getAmount()) {
            $data['amount'] = $this->getAmount();
        }

        return $data;
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->getUrl() . '/deposit.do';
    }
}
