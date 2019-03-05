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
                $this->messageManager->addErrorMessage(__('To calculate shipping we need items, store and destination postal code.'));
                return false;
            }

            $params = [
                'SellerCEP' => $storePostcode,
                'RecipientCEP' => (string)$destPostcode,
                'ShipmentInvoiceValue' => (double)$request->getBaseSubtotalInclTax(),
                'ShippingItemArray' => $this->getItems($items)
            ];
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage(__('Something went wrong trying to generate data to calculate the shipping value.'));
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

            $apiItems[] =
                [
                    'Weight' => $item->getWeight() ?? 0.3,
                    'Length' => $item->getLength() ?? 100,
                    'Height' => $item->getHeight() ?? 100,
                    'SKU' => (string)$item->getSku(),
                    'Quantity' => $item->getQty()
                ];
        }

        return $apiItems;
    }

}
