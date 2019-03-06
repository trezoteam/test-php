<?php

namespace Walisson\TrezoShippingTest\Helper\Shipping\Quote;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Framework\Message\ManagerInterface;
use Walisson\TrezoShippingTest\Helper\Config;


/**
 *
 * Class Adapter
 *
 * @package Walisson\TrezoShippingTest\Helper\Shipping\Quote
 */
class Adapter extends \Magento\Framework\App\Helper\AbstractHelper
{
    const MIN_WEIGHT = 0.3;
    const MIN_LENGTH = 10;
    const MIN_HEIGHT = 10;
    const MIN_WIDTH = 10;

    /** @var string */
    const SHIPPING_QUOTE_ENDPOINT = 'shipping/quote';

    /** @var ManagerInterface */
    protected $messageManager;

    /** @var Config */
    protected $configHelper;

    /**
     * Adapter constructor.
     *
     * @param Context $context
     * @param ManagerInterface $managerInterface
     * @param Config $configHelper
     */
    public function __construct(
        Context $context,
        ManagerInterface $managerInterface,
        Config $configHelper

    ) {
        $this->messageManager = $managerInterface;
        $this->configHelper = $configHelper;
        parent::__construct($context);
    }

    /**
     * Get Adapter Params
     *
     * @param RateRequest $request
     * @return array|bool
     */
    public function getParams(RateRequest $request)
    {
        try {
            $items = $request->getAllItems();
            $destPostcode = $request->getDestPostcode();
            $storePostcode = $request->getStorePostcode();

            if (!$items || !$destPostcode || !$storePostcode) {
                $this->_logger->error(strtoupper(Config::METHOD_CODE) . ' - ERROR: ' . __('To calculate shipping we need items, store and destination postal code.'));
                return false;
            }

            $params = [
                'SellerCEP' => $storePostcode,
                'RecipientCEP' => (string)$destPostcode,
                'ShipmentInvoiceValue' => (double)$request->getBaseSubtotalInclTax(),
                'ShippingItemArray' => $this->getItems($items)
            ];
        } catch (LocalizedException $e) {
            $this->_logger->error(strtoupper(Config::METHOD_CODE) . ' - ERROR: ' . __('Something went wrong trying to generate data to calculate the shipping value.') . 'STACK_TRACE' . $e->getTraceAsString());
            return false;
        }
        return $params;
    }

    /**
     * Get well formatted items with minimal structure
     *
     * @param array $items
     * @return array|bool
     */
    private function getItems($items = [])
    {
        $apiItems = [];
        foreach ($items as $item) {

            if ($item->getIsVirtual()) {
                continue;
            }

            $product = $item->getProduct();
            /**
             * Here we can use many strategies, as create the dimensional attributes, map already created attributes and so on.
             * For the test I've used just a "auto map" to find some attribute that has the dimension name on it's name, and it's not a real world ideal implementation,
             * and in this case, maybe a attribute map on the method admin configuration with creation of an EAV in case it doesn't exist.
             */
            $apiItems[] =
                [
                    'Weight' => $product->getWeight() ?? $this->getProductDimension($product, 'WEIGHT'),
                    'Length' => $product->getLength() ?? $this->getProductDimension($product, 'LENGTH'),
                    'Height' => $product->getHeight() ?? $this->getProductDimension($product, 'HEIGHT'),
                    'Width' => $product->getWidth() ?? $this->getProductDimension($product, 'WIDTH'),
                    'SKU' => (string)$item->getSku(),
                    'Quantity' => $item->getQty()
                ];
        }

        return $apiItems;
    }

    /**
     * Get a product attribute value that has the requested attribute name on it.
     *
     * @param $product
     * @param $attribute_name
     * @return float|string
     */
    private function getProductDimension($product, $attribute_name)
    {
        $attributes = $product->getAttributes();

        foreach ($attributes as $attribute) {
            if (strpos($attribute->getAttributeCode(), strtolower($attribute_name)) !== false) {
                return (float)$product->getData($attribute->getAttributeCode());
            }
        }

        return self::MIN_ . $attribute_name;
    }

}
