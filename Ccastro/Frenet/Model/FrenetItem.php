<?php

namespace Ccastro\Frenet\Model;

use Magento\Framework\DataObject;
use Ccastro\Frenet\Api\FrenetItemInterface;

/**
 * Class FrenetItem
 * @package Ccastro\Frenet\Model
 */
class FrenetItem extends DataObject implements FrenetItemInterface
{
    /**
     * @inheritdoc
     */
    public function getWidth()
    {
        return $this->getData(self::WIDTH);
    }

    /**
     * @inheritdoc
     */
    public function getWeight()
    {
        return $this->getData(self::WEIGHT);
    }

    /**
     * @inheritdoc
     */
    public function getLength()
    {
        return $this->getData(self::LENGTH);
    }

    /**
     * @inheritdoc
     */
    public function getHeight()
    {
        return $this->getData(self::HEIGHT);
    }

    /**
     * @inheritdoc
     */
    public function getDiameter()
    {
        return $this->getData(self::DIAMETER);
    }

    /**
     * @inheritdoc
     */
    public function getSku()
    {
        return $this->getData(self::SKU);
    }

    /**
     * @inheritdoc
     */
    public function getCategory()
    {
        return $this->getData(self::CATEGORY);
    }

    /**
     * @inheritdoc
     */
    public function getQuantity()
    {
        return $this->getData(self::QUANTITY);
    }

    /**
     * @inheritdoc
     */
    public function isFragile()
    {
        return (bool) $this->getData(self::IS_FRAGILE);
    }

    /**
     * @inheritdoc
     */
    public function setWeight($value)
    {
        $this->setData(self::WEIGHT, $value);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setWidth($value)
    {
        $this->setData(self::WIDTH, $value);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setLength($value)
    {
        $this->setData(self::LENGTH, $value);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setHeight($value)
    {
        $this->setData(self::HEIGHT, $value);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setDiameter($value)
    {
        $this->setData(self::DIAMETER, $value);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setSku($value)
    {
        $this->setData(self::SKU, $value);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setCategory($value)
    {
        $this->setData(self::CATEGORY, $value);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setQuantity($value)
    {
        $this->setData(self::QUANTITY, $value);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setIsFragile($value)
    {
        $this->setData(self::IS_FRAGILE, $value);
        return $this;
    }
}
