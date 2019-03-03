<?php

namespace Ccastro\Frenet\Model\Api;

use Magento\Framework\App\Config\ScopeConfigInterface as ScopeConfig;
use Magento\Framework\Encryption\Encryptor;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface as StoreManager;

/**
 * Class Auth
 * @package Ccastro\Frenet\Model\Api
 */
class Auth
{
    /**
     * Store Configuration Key for Api Key
     */
    const FRENET_API_KEY = 'carriers/frenet/key';

    /**
     * Store Configuration Key for Api Pass
     */
    const FRENET_API_PASS = 'carriers/frenet/password';

    /**
     * Store Configuration Key for Api Token
     */
    const FRENET_API_TOKEN = 'carriers/frenet/token';

    /**
     * @var ScopeConfig
     */
    private $scopeConfig;

    /**
     * @var StoreManager
     */
    private $storeManager;

    /**
     * @var Encryptor
     */
    private $encryptor;

    /**
     * Auth constructor.
     * @param ScopeConfig $scopeConfig
     * @param StoreManager $storeManager
     */
    public function __construct(
        ScopeConfig $scopeConfig,
        StoreManager $storeManager,
        Encryptor $encryptor
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->encryptor = $encryptor;
    }

    /**
     * Returns auth header to be used by Frenet api clients
     * @param $storeId
     * @return string[]
     * @throws NoSuchEntityException
     */
    public function getAuthHeaders($storeId)
    {
        return [
            'Content-Type' => 'application/json',
            'Token' => $this->getFrenetApiToken(),
        ];
    }

    /**
     * Frenet api key set in the Admin Store Configuration.
     * @param int|null $storeId
     * @return string
     * @throws NoSuchEntityException
     */
    public function getFrenetApiKey($storeId = null)
    {
        if ($storeId === null) {
            $storeId = $this->getCurrentStoreId();
        }
        return $this->scopeConfig->getValue(self::FRENET_API_KEY, ScopeInterface::SCOPE_STORE, $storeId);
    }

    /**
     * Frenet api pass set in the Admin Store Configuration.
     * @param int|null $storeId
     * @return string
     * @throws NoSuchEntityException
     */
    public function getFrenetApiPass($storeId = null)
    {
        if ($storeId === null) {
            $storeId = $this->getCurrentStoreId();
        }
        return $this->encryptor->decrypt(
            $this->scopeConfig->getValue(self::FRENET_API_PASS, ScopeInterface::SCOPE_STORE, $storeId)
        );
    }

    /**
     * Frenet api token set in the Admin Store Configuration.
     * @param int|null $storeId
     * @return string
     * @throws NoSuchEntityException
     */
    public function getFrenetApiToken($storeId = null)
    {
        if ($storeId === null) {
            $storeId = $this->getCurrentStoreId();
        }
        return $this->encryptor->decrypt(
            $this->scopeConfig->getValue(self::FRENET_API_TOKEN, ScopeInterface::SCOPE_STORE, $storeId)
        );
    }

    /**
     * Returns the ID of the current store
     * @return int
     * @throws NoSuchEntityException
     */
    private function getCurrentStoreId()
    {
        return $this->storeManager->getStore()->getId();
    }
}
