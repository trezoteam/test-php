<?php

class Alessandro_Shipping_Model_Carrier
    extends Mage_Shipping_Model_Carrier_Abstract
    implements Mage_Shipping_Model_Carrier_Interface
{
    /**
     * Carrier's code, as defined in parent class
     *
     * @var string
     */
    protected $_code = 'alessandro_shipping';

    /**
     * Collect and get rates
     *
     * @param Mage_Shipping_Model_Rate_Request $request
     * @return Mage_Shipping_Model_Rate_Result
     */
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        $ws_quote_return = $this->getQuoteWebService($request);

        if($ws_quote_return){
            $ws_quote_return = json_decode($ws_quote_return);
            if(count($ws_quote_return->ShippingSevicesArray) < 1) return false;
             /** @var Mage_Shipping_Model_Rate_Result $result */
            $result = Mage::getModel('shipping/rate_result');
            foreach ($ws_quote_return->ShippingSevicesArray as $method){
                $result->append($this->addMethod($method));
            }
            return $result;
        }
        return false;

    }

    /**
     * Get frenet delivery time with additional days
     *
     * @param int
     * @return int
     * */
    private function getDeliveryTime($days)
    {
        $additional_days = $this->getConfigData('additional_days');
        if(empty($additional_days)) $additional_days = 0;
        if(empty($days)) $days = 0;
        return $additional_days + $days;
    }

    /**
     * Get allowed shipping methods
     *
     * @return array
     */
    public function getAllowedMethods()
    {
        return array(
            $this->_code => "Frenet"
        );
    }

    /**
     * @param $method
     * @return Mage_Shipping_Model_Rate_Result_Method
     */
    protected function addMethod($method){
        /** @var Mage_Shipping_Model_Rate_Result_Method $rate */
        $rate = Mage::getModel('shipping/rate_result_method');

        $rate->setCarrier($this->_code);
        $rate->setCarrierTitle($this->getConfigData('title'));
        $rate->setMethod($method->ServiceDescription );
        $rate->setMethodTitle($method->ServiceDescription . " - " . $this->getDeliveryTime($method->DeliveryTime)
            . " " . __('days'));
        $rate->setPrice($method->ShippingPrice);
        $rate->setCost($method->ShippingPrice);
        return $rate;
    }

    /**
     * Get Quote From Frenet WebService
     * @return bool|string
     * */
    public function getQuoteWebService(Mage_Shipping_Model_Rate_Request $request)
    {
        $ws_url = Mage::helper('alessandro_shipping')->getWsUrl();

        $seller_postal_code = Mage::getStoreConfig('shipping/origin/postcode');
        if(empty($seller_postal_code)) return false;

        $recipient_postal_code = $request->getDestPostcode();
        if(empty($recipient_postal_code)) return false;
        $recipient_country_id = $request->getDestCountryId();
        $order_subtotal = $request->getOrderSubtotal();
        if(empty($order_subtotal)) $order_subtotal = 19.5; //minimun frenet value

        $items = [];
        foreach ($request->getAllItems() as $item) {
            $length = (!empty($item->getProduct()->getData('length'))) ? $item->getProduct()->getData('length') : 16;
            $width = (!empty($item->getProduct()->getData('width'))) ? $item->getProduct()->getData('width') : 11;
            $height = (!empty($item->getProduct()->getData('height'))) ? $item->getProduct()->getData('height') : 2;

            $ship_item = new stdClass();
            $ship_item->Weight = $item->getWeight();
            $ship_item->Length = $length;
            $ship_item->Height = $height;
            $ship_item->Width = $width;
            $ship_item->Quantity = $item->getTotalQty();
            $ship_item->SKU = $item->getSku();

            $items [] = $ship_item;
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $ws_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        $post = new stdClass();
        $post->SellerCEP = $seller_postal_code;
        $post->RecipientCEP = $recipient_postal_code;
        $post->ShipmentInvoiceValue = $order_subtotal;
        $post->ShippingItemArray = $items;
        $post->RecipientCountry = $recipient_country_id;

        $params = array(
          "SellerCEP" => $seller_postal_code,
          "RecipientCEP" => $recipient_postal_code,
          "ShipmentInvoiceValue" => $order_subtotal,
          "ShippingItemArray" => $items,
          "RecipientCountry" => $recipient_country_id
        );

        $token = $this->getConfigData('token');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "token: {$token}"
        ));
        try {
            $response = curl_exec($ch);
            curl_close($ch);
            return $response;
        }catch(Exception $e){
            Mage::log("Error: ". $e->getMessage());
        }
        return false;
    }
}
