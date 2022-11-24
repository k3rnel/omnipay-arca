<?php

namespace Omnipay\Arca\Message\Request;

class GetBindingsRequest extends AbstractBindingAwareRequest
{
    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return array
     */
    public function getData() : array
    {
        $data = parent::getData();
        $data['userName'] = $this->getUsername();
        $data['clientId'] = $this->getClientId();

        return $data;
    }

    /**
     * @return string
     */
    public function getEndpoint() : string
    {
        return $this->getUrl().'/getBindings.do';
    }
}
