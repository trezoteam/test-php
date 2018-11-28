<?php
/**
 *
 * @category   Trezo
 * @package    Trezo_Payments
 * @author     Rone Clay Santos <https://github.com/roneclay>
 *
 */

class Trezo_Payments_Model_Api
{
    const TREZO_END_POINT = 'https://sandbox.pagueveloz.com.br/api/';

    protected $_authorizationKey;

    /**
     * Trezo_Payments_Model_Api constructor.
     */
    public function __construct()
    {
        $this->_authorizationKey = Mage::getStoreConfig('payment/trezo_settings/authentication_key' );
    }

    /**
     * @param $params
     * @param $url
     * @return bool|string
     */
    public function prepareCurl($params, $url)
    {
        $curl = curl_init();
        $curl_array = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 40,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "Accept: application/json",
                "content-type: application/json",
                "Authorization: Basic " . $this->_authorizationKey,
            ),
        );

        curl_setopt_array($curl, $curl_array);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ( $err )
            return $err;

        return $response;
    }
}
