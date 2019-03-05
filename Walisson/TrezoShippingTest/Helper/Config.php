<?php

namespace Walisson\TrezoShippingTest\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Walisson\TrezoShippingTest\Api\Data\ConfigInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class Config
 *
 * @package Walisson\TrezoShippingTest\Helper
 */
class Config extends AbstractHelper implements ConfigInterface
{

    /** @var StoreManagerInterface  */
    protected $storeManager;

    /**
     * Config constructor.
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager
    ) {
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }

    /**
     * Get a config value by the current website
     *
     * @param $value
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getValue($value)
    {
        return $this->scopeConfig->getValue($value, \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore()->getWebsiteId());
    }


}