<?php

namespace Walisson\TrezoShippingTest\Model\Carrier;

use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Shipping\Model\Rate\Result;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory;
use Psr\Log\LoggerInterface;
use Magento\Shipping\Model\Rate\ResultFactory;
use Magento\Quote\Model\Quote\Address\RateResult\MethodFactory;
use Walisson\TrezoShippingTest\Helper\Provider;
use Walisson\TrezoShippingTest\Helper\Shipping\Quote\Adapter;
use Walisson\TrezoShippingTest\Api\Data\ConfigInterface;

/**
 * Class Shipping
 *
 * @package Walisson\TrezoShippingTest\Model\Carrier
 */
class Shipping extends \Magento\Shipping\Model\Carrier\AbstractCarrier implements \Magento\Shipping\Model\Carrier\CarrierInterface
{

    /** @var string */
    protected $_code = ConfigInterface::METHOD_CODE;

    /** @var ResultFactory */
    protected $_rateResultFactory;

    /** @var MethodFactory */
    protected $_rateMethodFactory;

    /** @var Provider  */
    protected $provider;

    /** @var Adapter  */
    protected $adapter;

    /** @var string  */
    protected $methodName = '';


    /**
     * Shipping constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     * @param ErrorFactory $rateErrorFactory
     * @param LoggerInterface $logger
     * @param ResultFactory $rateResultFactory
     * @param MethodFactory $rateMethodFactory
     * @param Provider $provider
     * @param Adapter $adapter
     * @param array $data
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        ErrorFactory $rateErrorFactory,
        LoggerInterface $logger,
        ResultFactory $rateResultFactory,
        MethodFactory $rateMethodFactory,
        Provider $provider,
        Adapter $adapter,
        array $data = []
    ) {
        $this->_rateResultFactory = $rateResultFactory;
        $this->_rateMethodFactory = $rateMethodFactory;
        $this->provider = $provider;
        $this->adapter = $adapter;
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
    }

    /**
     * Get Allowed Methods
     *
     * @return array
     */
    public function getAllowedMethods()
    {
        return [$this->_code => $this->getConfigData('name')];
    }

    /**
     * Get the store postcode
     *
     * @return mixed
     */
    private function getStorePostcode()
    {
        return $this->_scopeConfig->getValue('general/store_information/postcode');
    }


    /**
     * Get Shipping Price
     *
     * @param RateRequest $request
     * @return int
     */
    private function getShippingPrice(RateRequest $request)
    {
        $storePostcode = $this->getStorePostcode();
        if (!$storePostcode) {
            $this->_logger->error(strtoupper(ConfigInterface::METHOD_CODE) .' - MESSAGE: '. __('Store postal code not found.'));
            return false;
        }

        $request->setData('store_postcode',$storePostcode);
        $params = $this->adapter->getParams($request);

        if (!$params) {
            $this->_logger->error(strtoupper(ConfigInterface::METHOD_CODE) .' - MESSAGE: '. __('Cannot get params to do the api request.'));
            return false;
        }

        $result = json_decode($this->provider->postApi(Adapter::SHIPPING_QUOTE_ENDPOINT, json_encode($params)));
        if ($result && $result->error) {
            $this->_logger->error(strtoupper(ConfigInterface::METHOD_CODE) .' - MESSAGE: '. $result->error_message . ' STACK_TRACE: ' .$result->StackTrace);
            return false;
        }

        $shippingPrice = $this->getShippingAmount($result->ShippingSevicesArray);

        $deliveryDays = $this->getConfigData('delivery_additional_days');
        $deliveryDays += $this->getDeliveryTimeAmount($result->ShippingSevicesArray);

        $this->methodName = $this->getCarrierAndService($result) . ' - ' . __('Delivery time (in days): ') . $deliveryDays;

        $shippingPrice = $this->getFinalPriceWithHandlingFee($shippingPrice);

        return $shippingPrice;
    }

    /**
     * Get Carrier name and service
     *
     * @param $result
     * @return false|string
     */
    private function getCarrierAndService($result)
    {
        if (!isset($result->ShippingSevicesArray) || !is_array($result->ShippingSevicesArray) || !count($result->ShippingSevicesArray)) {
            return $this->getConfigData('name');
        }

        $item = $result->ShippingSevicesArray[0];
        return $item->Carrier .'/'. $item->ServiceDescription;

    }

    /**
     * Get Shipping Amount
     *
     * @param $items
     * @return bool|float
     */
    private function getShippingAmount($items)
    {
        if (!$items) {
            $this->_logger->error(strtoupper(ConfigInterface::METHOD_CODE) .' - ERROR: '. __('Items not found to get total amount.'));
            return false;
        }

        $amount = 0.0;

        foreach ($items as $item) {
            $amount += $item->ShippingPrice;
        }

        return $amount;
    }

    /**
     * Get delivery time from the api result
     *
     * @param $items
     * @return bool|int
     */
    private function getDeliveryTimeAmount($items)
    {
        if (!$items) {
            return 0;
        }

        $amount = 0;

        foreach ($items as $item) {
            $amount += $item->DeliveryTime;
        }

        return $amount;
    }

    /**
     * @param RateRequest $request
     * @return bool|Result
     */
    public function collectRates(RateRequest $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }

        /** @var \Magento\Shipping\Model\Rate\Result $result */
        $result = $this->_rateResultFactory->create();

        /** @var \Magento\Quote\Model\Quote\Address\RateResult\Method $method */
        $method = $this->_rateMethodFactory->create();

        $method->setCarrier($this->_code);
        $method->setCarrierTitle($this->getConfigData('title'));

        $amount = $this->getShippingPrice($request);
        if (!$amount) {
            $this->_logger->error(strtoupper(ConfigInterface::METHOD_CODE) .' - ERROR: '. __('Cannot found the quote total amount.'));
            return false;
        }

        $method->setMethod($this->_code);
        $method->setMethodTitle($this->methodName);

        $method->setPrice($amount);
        $method->setCost($amount);

        $result->append($method);

        return $result;
    }
}
