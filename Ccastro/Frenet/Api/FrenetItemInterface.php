<?php
namespace Ccastro\Frenet\Api;

/**
 * Interface FrenetInterface
 * @package Ccastro\Frenet\Api
 */
interface FrenetItemInterface
{
    /**
     * Shipping Item Properties
     * http://api.frenet.com.br/shipping/quote
     */
    const WEIGHT = "Weight";
    const LENGTH =  "Length";
    const HEIGHT =  "Height";
    const WIDTH =  "Width";
    const QUANTITY =  "Quantity";
    const DIAMETER = "Diameter";
    const SKU = "SKU";
    const CATEGORY =  "Category";
    const IS_FRAGILE =  "isFragile";

    /**
     * Get shipping item weight
     * @return float
     */
    public function getWeight();

    /**
     * Get shipping item width
     * @return float
     */
    public function getWidth();

    /**
     * Get shipping item length
     * @return float
     */
    public function getLength();

    /**
     * Get shipping item height
     * @return float
     */
    public function getHeight();

    /**
     * Get shipping item diameter
     * @return float
     */
    public function getDiameter();

    /**
     * Get shipping item sku
     * @return string
     */
    public function getSku();

    /**
     * Get shipping item category
     * @return string
     */
    public function getCategory();

    /**
     * Get shipping item quantity
     * @return int
     */
    public function getQuantity();

    /**
     * Get shipping item is fragile
     * @return boolean
     */
    public function isFragile();

    /**
     * Set shipping item weight
     * @param $value
     * @return float
     */
    public function setWeight($value);

    /**
     * Set shipping item width
     * @param $value
     * @return float
     */
    public function setWidth($value);

    /**
     * Set shipping item length
     * @param $value
     * @return mixed
     */
    public function setLength($value);

    /**
     * Set shipping item height
     * @param $value
     * @return mixed
     */
    public function setHeight($value);

    /**
     * Set shipping item diameter
     * @param $value
     * @return mixed
     */
    public function setDiameter($value);

    /**
     * Set shipping item sku
     * @param $value
     * @return mixed
     */
    public function setSku($value);

    /**
     * Set shipping item category
     * @param $value
     * @return mixed
     */
    public function setCategory($value);

    /**
     * Set shipping item quantity
     * @param $value
     * @return mixed
     */
    public function setQuantity($value);

    /**
     * Set shipping item is_fragile
     * @param $value
     * @return mixed
     */
    public function setIsFragile($value);
}
