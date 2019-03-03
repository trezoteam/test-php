<?php
namespace Ccastro\Frenet\Api;

/**
 * Interface FrenetRequestInterface
 * @package Ccastro\Frenet\Api
 */
interface FrenetRequestInterface
{

    /**
     * Properties
     * http://api.frenet.com.br/shipping/quote
     */
    const SELLER_CEP = 'SellerCEP';
    const RECIPIENT_CEP = 'RecipientCEP';
    const SHIPMENT_INVOICE_VALUE = 'ShipmentInvoiceValue';
    const RECIPIENT_COUNTRY = 'RecipientCountry';
    const SHIPPING_SERVICE_CODE = 'ShippingServiceCode';
    const COUPOM = 'Coupom';
    const SHIPPING_ITEM_ARRAY = 'ShippingItemArray';

    /**
     * Get Seller Cep
     * @return string
     */
    public function getSellerCep();

    /**
     * Get Recipien tCEP
     * @return string
     */
    public function getRecipientCEP();

    /**
     * Get Shipment Invoice Value
     * @return float
     */
    public function getShipmentInvoiceValue();

    /**
     * Get Recipient Country
     * @return string
     */
    public function getRecipientCountry();

    /**
     * Get Shipping Service Code
     * @return string
     */
    public function getShippingServiceCode();

    /**
     * Get Coupom
     * @return string
     */
    public function getCoupom();


    /**
     * Get Shipping Item Array
     * @return FrenetItemInterface[]
     */
    public function getShippingItemArray();

    /**
     * Set Seller Cep
     * @param string $value
     * @return FrenetRequestInterface
     */
    public function setSellerCep($value);

    /**
     * Set Recipien CEP
     * @param string $value
     * @return FrenetRequestInterface
     */
    public function setRecipientCEP($value);

    /**
     * Set Shipment Invoice Value
     * @param float $value
     * @return FrenetRequestInterface
     */
    public function setShipmentInvoiceValue($value);

    /**
     * Set Recipient Country
     * @param string $value
     * @return FrenetRequestInterface
     */
    public function setRecipientCountry($value);

    /**
     * Set Shipping Service Code
     * @param string $value
     * @return FrenetRequestInterface
     */
    public function setShippingServiceCode($value);

    /**
     * Set Coupom
     * @param string $value
     * @return FrenetRequestInterface
     */
    public function setCoupom($value);


    /**
     * Set Shipping Item Array
     * @param FrenetItemInterface[] $value
     * @return FrenetRequestInterface
     */
    public function setShippingItemArray($value);

}
