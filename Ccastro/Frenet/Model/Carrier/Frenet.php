<?php

namespace Ccastro\Frenet\Model\Carrier;

use Magento\Catalog\Model\Product;
use Magento\Framework\Xml\Security;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Quote\Model\Quote\Item;
use Magento\Sales\Model\Order\Shipment;
use Magento\Shipping\Model\Rate\Result as RateResult;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Shipping\Model\Tracking\Result\ErrorFactory as TrackingErrorFactory;
use Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory;
use Psr\Log\LoggerInterface;
use Magento\Shipping\Model\Rate\ResultFactory;
use Magento\Quote\Model\Quote\Address\RateResult\MethodFactory;
use Magento\Shipping\Model\Carrier\CarrierInterface;
use Magento\Framework\DataObject;
use Magento\Shipping\Model\Tracking\ResultFactory as TrackingResultFactory;
use Magento\Shipping\Model\Tracking\Result\StatusFactory as TrackingStatusFactory;
use Magento\Directory\Model\RegionFactory;
use Magento\Directory\Model\CountryFactory;
use Magento\Directory\Model\CurrencyFactory;
use Magento\Directory\Helper\Data;
use Magento\Framework\DataObjectFactory;
use Magento\CatalogInventory\Api\StockRegistryInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Shipping\Model\Simplexml\ElementFactory;
use Magento\Framework\Encryption\EncryptorInterface;
use Ccastro\Frenet\Api\FrenetShippingServicesInterface;
use Ccastro\Frenet\Model\FrenetItem;
use Ccastro\Frenet\Model\FrenetRequest;
use Ccastro\Frenet\Model\FrenetRequestFactory;
use Magento\Framework\Serialize\Serializer\Json as JsonSerializer;
use Ccastro\Frenet\Model\Api\Shipping\Quote as FrenetShippingQuote;
use Magento\Catalog\Model\CategoryRepository;
use Magento\Shipping\Model\Carrier\AbstractCarrierOnline;


class Frenet extends AbstractCarrierOnline implements CarrierInterface

{

    const BRASIL_COUNTRY_ID = 'BR';

    const DEFAULT_HEIGHT_CONFIG_PATH = 'default_dimensional_height';
    const DEFAULT_LENGTH_CONFIG_PATH = 'default_dimensional_length';
    const DEFAULT_WIDTH_CONFIG_PATH = 'default_dimensional_width';

    const ADD_DELIVERY_DAYS_PATH = 'add_delivery_days';
    const SHIPPING_MESSAGE_PATH = 'shipping_message';

    /**
     * @var string
     */
    protected $_code = 'frenet';

    /**
     * @var ResultFactory
     */
    private $rateResultFactory;

    /**
     * @var MethodFactory
     */
    private $rateMethodFactory;

    /**
     * @var DataObjectFactory
     */
    private $dataObjectFactory;

    /**
     * Rate request data
     *
     * @var RateRequest|null
     */
    private $request = null;

    /**
     * Rate result data
     * @var RateResult|null
     */
    private $result = null;

    /**
     * @var EncryptorInterface
     */
    private $encryptor;

    /**
     * @var FrenetRequestFactory
     */
    private $frenetRequestFactory;

    /**
     * @var JsonSerializer
     */
    private $jsonSerializer;

    /**
     * @var FrenetShippingQuote
     */
    private $frenetShippingQuote;

    /**
     * @var FrenetRequest
     */
    private $frenetRequest;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * Frenet constructor.
     * @param ScopeConfigInterface $scopeConfig
     * @param ErrorFactory $rateErrorFactory
     * @param LoggerInterface $logger
     * @param Security $xmlSecurity
     * @param ElementFactory $xmlElFactory
     * @param ResultFactory $rateFactory
     * @param MethodFactory $rateMethodFactory
     * @param TrackingResultFactory $trackFactory
     * @param TrackingErrorFactory $trackErrorFactory
     * @param TrackingStatusFactory $trackStatusFactory
     * @param RegionFactory $regionFactory
     * @param CountryFactory $countryFactory
     * @param CurrencyFactory $currencyFactory
     * @param Data $directoryData
     * @param StockRegistryInterface $stockRegistry
     * @param DataObjectFactory $dataObjectFactory
     * @param RateRequest $request
     * @param RateResult $result
     * @param ResultFactory $rateResultFactory
     * @param EncryptorInterface $encryptor
     * @param FrenetRequestFactory $frenetRequestFactory
     * @param JsonSerializer $jsonSerializer
     * @param FrenetShippingQuote $frenetShippingQuote
     * @param CategoryRepository $categoryRepository
     * @param array $data
     * @SuppressWarnings(PHPMD)
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        ErrorFactory $rateErrorFactory,
        LoggerInterface $logger,
        Security $xmlSecurity,
        ElementFactory $xmlElFactory,
        ResultFactory $rateFactory,
        MethodFactory $rateMethodFactory,
        TrackingResultFactory $trackFactory,
        TrackingErrorFactory $trackErrorFactory,
        TrackingStatusFactory $trackStatusFactory,
        RegionFactory $regionFactory,
        CountryFactory $countryFactory,
        CurrencyFactory $currencyFactory,
        Data $directoryData,
        StockRegistryInterface $stockRegistry,
        DataObjectFactory $dataObjectFactory,
        RateRequest $request,
        RateResult $result,
        ResultFactory $rateResultFactory,
        EncryptorInterface $encryptor,
        FrenetRequestFactory $frenetRequestFactory,
        JsonSerializer $jsonSerializer,
        FrenetShippingQuote $frenetShippingQuote,
        CategoryRepository $categoryRepository,
        array $data = []
    ) {

        $this->rateResultFactory = $rateResultFactory;
        $this->rateMethodFactory = $rateMethodFactory;
        $this->dataObjectFactory = $dataObjectFactory;
        $this->request = $request;
        $this->result = $result;
        $this->encryptor = $encryptor;
        $this->frenetRequestFactory = $frenetRequestFactory;
        $this->jsonSerializer = $jsonSerializer;

        $this->frenetShippingQuote = $frenetShippingQuote;
        $this->categoryRepository = $categoryRepository;

        parent::__construct(
            $scopeConfig,
            $rateErrorFactory,
            $logger,
            $xmlSecurity,
            $xmlElFactory,
            $rateFactory,
            $rateMethodFactory,
            $trackFactory,
            $trackErrorFactory,
            $trackStatusFactory,
            $regionFactory,
            $countryFactory,
            $currencyFactory,
            $directoryData,
            $stockRegistry,
            $data
        );
    }

    /**
     * Get allowed shipping methods
     *
     * @return array
     */
    public function getAllowedMethods()
    {
        return [$this->_code => $this->getConfigData('name')];
    }

    /**
     * Collect and get rates
     * @param RateRequest $request
     * @return bool|DataObject|\Magento\Quote\Model\Quote\Address\RateResult\Error|RateResult|null
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function collectRates(RateRequest $request)
    {
        if (!$this->canCollectRates()) {
            return $this->getErrorMessage();
        }
        $this->setRequest($request);
        $this->getQuotes();
        return $this->getResult();
    }

    /**
     * Prepare and set request to this instance
     * @param RateRequest $request
     * @return $this
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    private function setRequest(RateRequest $request)
    {
        $this->request = $request;

        /** @var FrenetRequest $frenetRequest */
        $frenetRequest = $this->frenetRequestFactory->create();

        //SellerCEP
        if ($request->getOrigPostcode()) {
            $frenetRequest->setSellerCep($request->getOrigPostcode());
        } else {
            $frenetRequest->setSellerCep(
                $this->_scopeConfig->getValue(
                    Shipment::XML_PATH_STORE_ZIP,
                    ScopeInterface::SCOPE_STORE,
                    $request->getStoreId()
                )
            );
        }

        //RecipientCEP
        if ($request->getDestPostcode()) {
            $frenetRequest->setRecipientCEP($request->getDestPostcode());
        }

        //RecipientCountry
        if ($request->getDestCountryId()) {
            $destCountry = $request->getDestCountryId();
        } else {
            $destCountry = self::BRASIL_COUNTRY_ID;
        }
        $frenetRequest->setRecipientCountry($this->_countryFactory->create()->load($destCountry)->getData('iso2_code'));

        //ShipmentInvoiceValue
        $frenetRequest->setShipmentInvoiceValue($request->getPackageValue());

        //ShippingServiceCode
        if ($request->getShippingServiceCode()) {
            $frenetRequest->setShippingServiceCode($request->getShippingServiceCode());
        }

        //Coupon
        if ($request->getCoupon()) {
            $frenetRequest->setCoupom($request->getCoupon());
        }

        //ShippingItemArray
        $frenetRequest->setShippingItemArray($this->getShippingItemArray($request));

        //Set frenet request
        $this->setFrenetRequest($frenetRequest);

        return $this;
    }

    /**
     * Currently tracking is not implemented
     * http://api.frenet.com.br/tracking/trackinginfo
     * @return bool
     */
    public function isTrackingAvailable()
    {
        return false;
    }

    /**
     * Get shipping item array
     * @param RateRequest $request
     * @return array|bool
     */
    private function getShippingItemArray(RateRequest $request)
    {
        $itemArray = [];
        $packageItems = $request->getAllItems();

        /** @var Item $item */
        foreach ($packageItems as $key => $item) {
            $itemWeight = $item->getWeight();
            if (!$itemWeight) {
                return false;
            }
            $itemArray[$key][FrenetItem::WEIGHT] = $itemWeight;

            $itemHeight = $item->getFrenetDimensionHeight();
            if (!$itemHeight) {
                $itemHeight = $this->getConfigData(self::DEFAULT_HEIGHT_CONFIG_PATH);
            }
            $itemArray[$key][FrenetItem::WEIGHT] = $itemHeight;

            $itemLength = $item->getFrenetDimensionLength();
            if (!$itemLength) {
                $itemLength = $this->getConfigData(self::DEFAULT_LENGTH_CONFIG_PATH);
            }
            $itemArray[$key][FrenetItem::LENGTH] = $itemLength;

            $itemWidth = $item->getFrenetDimensionWidth();
            if (!$itemWidth) {
                $itemWidth = $this->getConfigData(self::DEFAULT_WIDTH_CONFIG_PATH);
            }
            $itemArray[$key][FrenetItem::WIDTH] = $itemWidth;

            $itemDiameter = $item->getFrenetDimensionDiameter();
            if ($itemDiameter) {
                $itemArray[$key][FrenetItem::DIAMETER] = $itemDiameter;
            }

            $itemArray[$key][FrenetItem::SKU] = $item->getSku();

            $itemCategory = $this->getProductCategoriesAsString($item->getProduct());
            if ($itemCategory) {
                $itemArray[$key][FrenetItem::DIAMETER] = $itemDiameter;
            }

            $itemArray[$key][FrenetItem::QUANTITY] = $item->getQty();

            $itemIsFragile = $item->getFrenetIsFragile();
            if ($itemDiameter) {
                $itemArray[$key][FrenetItem::IS_FRAGILE] = $itemIsFragile;
            }
        }
        return $itemArray;
    }

    /**
     * Do remote request for and handle errors
     * @return RateResult|null
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    private function getQuotes()
    {
        $this->result = $this->rateResultFactory->create();

        //Make request
        $response = $this->frenetShippingQuote->execute($this->getFrenetRequest());
        $methods = $this->jsonSerializer->unserialize($response);
        $services = isset($methods['ShippingSevicesArray']) ? $methods['ShippingSevicesArray'] : null;
        if ($services) {
            foreach ($services as $method) {
                if (!$method[FrenetShippingServicesInterface::ERROR]) {
                    /** @var RateResult $rate */
                    $rate = $this->rateMethodFactory->create();
                    $rate->setCarrier($this->_code);
                    $rate->setCarrierTitle($this->getConfigData('title'));
                    $rate->setMethod($method[FrenetShippingServicesInterface::SERVICE_CODE]);
                    $rate->setMethodTitle($this->getMethodDescription($method));
                    $rate->setCost($method[FrenetShippingServicesInterface::SHIPPING_PRICE]);
                    $rate->setPrice($method[FrenetShippingServicesInterface::SHIPPING_PRICE]);
                    $this->result->append($rate);
                }
            }
        }
        return $this->result;
    }

    /**
     * Set frenet request
     * @param $request
     */
    private function setFrenetRequest($request)
    {
        $this->frenetRequest = $request;
    }

    /**
     * Get frenet request
     * @return FrenetRequest
     */
    private function getFrenetRequest()
    {
        return $this->frenetRequest;
    }

    /**
     * Get Result
     * @return RateResult|null
     */
    private function getResult()
    {
        return $this->result;
    }

    /**
     * Get Method Description
     * @param $method
     * @return string
     */
    private function getMethodDescription($method)
    {
        $totalDeliveryDays = $method[FrenetShippingServicesInterface::DELIVERY_TIME] + $this->getAddDeliveryDays();
        $deliveryMessage = $this->getDeliveryMessage();
        $methodName = $method[FrenetShippingServicesInterface::SERVICE_DESCRIPTION] .
            ' (' . $method[FrenetShippingServicesInterface::CARRIER] . ')';

        $description = sprintf(
            $deliveryMessage,
            $methodName,
            (int)$totalDeliveryDays
        );

        return $description;
    }

    /**
     * Get days to be added to shipping time
     * @return int
     */
    private function getAddDeliveryDays()
    {
        $return = 0;
        if ($this->getConfigData(self::ADD_DELIVERY_DAYS_PATH)) {
            $return = $this->getConfigData(self::ADD_DELIVERY_DAYS_PATH);
        }
        return $return;
    }

    /**
     * Return delivery message from admin
     * @return string
     */
    private function getDeliveryMessage()
    {
        $return = '';
        if ($this->getConfigData(self::SHIPPING_MESSAGE_PATH)) {
            $return = $this->getConfigData(self::SHIPPING_MESSAGE_PATH);
        }
        return $return;
    }

    /**
     * Get all category names as one string
     * @param Product $product
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    private function getProductCategoriesAsString(Product $product)
    {
        $categoryString = "";
        $categoryIds = $product->getCategoryIds();
        foreach ($categoryIds as $categoryId) {
            $categoryString .= $this->categoryRepository->get($categoryId)->getName() . ' ';
        }
        return $categoryString;
    }

    /**
     * @param DataObject $request
     * @return DataObject|void
     */
    protected function _doShipmentRequest(\Magento\Framework\DataObject $request)
    {
        // TODO: Implement _doShipmentRequest() method.
    }


}