<?php


namespace Ccastro\Frenet\Model;

use Magento\Framework\DataObject;
use Ccastro\Frenet\Api\FrenetRequestInterface;

/**
 * Interface FrenetRequest
 * @package Ccastro\Frenet\Model
 */
class FrenetRequest extends DataObject implements FrenetRequestInterface
{

    /**
     * @inheritdoc
     */
    public function getSellerCep()
    {
        return $this->getData(self::SELLER_CEP);
    }

    /**
     * @inheritdoc
     */
    public function getRecipientCEP()
    {
        return $this->getData(self::RECIPIENT_CEP);
    }

    /**
     * @inheritdoc
     */
    public function getShipmentInvoiceValue()
    {
        return $this->getData(self::SHIPMENT_INVOICE_VALUE);
    }

    /**
     * @inheritdoc
     */
    public function getRecipientCountry()
    {
        return $this->getData(self::RECIPIENT_COUNTRY);
    }

    /**
     * @inheritdoc
     */
    public function getShippingServiceCode()
    {
        return $this->getData(self::SHIPPING_SERVICE_CODE);
    }

    /**
     * @inheritdoc
     */
    public function getCoupom()
    {
        return $this->getData(self::COUPOM);
    }

    /**
     * @inheritdoc
     */
    public function getShippingItemArray()
    {
        return $this->getData(self::SHIPPING_ITEM_ARRAY);
    }

    /**
     * @inheritdoc
     */
    public function setSellerCep($value)
    {
        $this->setData(self::SELLER_CEP, $value);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setRecipientCEP($value)
    {
        $this->setData(self::RECIPIENT_CEP, $value);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setShipmentInvoiceValue($value)
    {
        $this->setData(self::SHIPMENT_INVOICE_VALUE, $value);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setRecipientCountry($value)
    {
        $this->setData(self::RECIPIENT_COUNTRY, $value);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setShippingServiceCode($value)
    {
        $this->setData(self::SHIPPING_SERVICE_CODE, $value);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setCoupom($value)
    {
        $this->setData(self::COUPOM, $value);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setShippingItemArray($value)
    {
        $this->setData(self::SHIPPING_ITEM_ARRAY, $value);
        return $this;
    }
}
