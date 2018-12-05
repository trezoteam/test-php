<?php

class Alessandro_Shipping_Helper_Data extends Mage_Core_Helper_Abstract {

    const FRENET_WEBSERVICE_URL = 'http://api.frenet.com.br/shipping/quote';

    /**
     * Get Frenet Web Service URL
     *
     * @return string
     */
    public function getWsUrl()
    {
        return self::FRENET_WEBSERVICE_URL;
    }

}
