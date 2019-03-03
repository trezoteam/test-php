<?php
namespace Ccastro\Frenet\Api;

/**
 * Interface FrenetRequestInterface
 * @package Ccastro\Frenet\Api
 */
interface FrenetShippingServicesInterface
{

    /**
     * Shipping Services Properties
     * http://api.frenet.com.br/shipping/quote
     */
    const SERVICE_CODE = 'ServiceCode';
    const SERVICE_DESCRIPTION = 'ServiceDescription';
    const CARRIER = 'Carrier';
    const SHIPPING_PRICE = 'ShippingPrice';
    const DELIVERY_TIME = 'DeliveryTime';
    const MSG = 'Msg';
    const ERROR = 'Error';
    const ORIGINAL_DELIVERY_TIME = 'OriginalDeliveryTime';
    const ORIGINAL_SHIPPING_PRICE = 'OriginalShippingPrice';
    const RESPONSE_TIME = 'ResponseTime';

    public function getToken();

    /**
     * Get Service Code
     * @return FrenetShippingServicesInterface
     */
    public function getServiceCode();

    /**
     * Get Service Description
     * @return FrenetShippingServicesInterface
     */
    public function getServiceDescription();

    /**
     * Get Carrier
     * @return float
     */
    public function getCarrier();

    /**
     * Get Shipping Price
     * @return FrenetShippingServicesInterface
     */
    public function getShippingPrice();

    /**
     * Get Delivery Time
     * @return FrenetShippingServicesInterface
     */
    public function getDeliveryTime();

    /**
     * Get Msg
     * @return FrenetShippingServicesInterface
     */
    public function getMsg();

    /**
     * Get Error
     * @return FrenetShippingServicesInterface
     */
    public function getError();

    /**
     * Get Original Delivery Time
     * @return FrenetShippingServicesInterface
     */
    public function getOriginalDeliveryTime();

    /**
     * Get Original Shipping Price
     * @return FrenetShippingServicesInterface
     */
    public function getOriginalShippingPrice();

    /**
     * Get Response Time
     * @return FrenetShippingServicesInterface
     */
    public function getResponseTime();

    /**
     * Set Service Code
     * @param string $value
     * @return FrenetShippingServicesInterface
     */
    public function setServiceCode($value);

    /**
     * Set Service Description
     * @param string $value
     * @return FrenetShippingServicesInterface
     */
    public function setServiceDescription($value);

    /**
     * Set Carrier
     * @param string $value
     * @return float
     */
    public function setCarrier($value);

    /**
     * Set Shipping Price
     * @param string $value
     * @return FrenetShippingServicesInterface
     */
    public function setShippingPrice($value);

    /**
     * Set Delivery Time
     * @param string $value
     * @return FrenetShippingServicesInterface
     */
    public function setDeliveryTime($value);

    /**
     * Set Msg
     * @param string $value
     * @return FrenetShippingServicesInterface
     */
    public function setMsg($value);

    /**
     * Set Error
     * @param string $value
     * @return FrenetShippingServicesInterface
     */
    public function setError($value);

    /**
     * Set Original Delivery Time
     * @param string $value
     * @return FrenetShippingServicesInterface
     */
    public function setOriginalDeliveryTime($value);

    /**
     * Set Original Shipping Price
     * @param string $value
     * @return FrenetShippingServicesInterface
     */
    public function setOriginalShippingPrice($value);

    /**
     * Set Response Time
     * @param string $value
     * @return FrenetShippingServicesInterface
     */
    public function setResponseTime($value);

}
