<?php

namespace Ccastro\Frenet\Model\Api\Shipping;

use Ccastro\Frenet\Model\Api\Auth;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientFactory as HttpClientFactory;
use GuzzleHttp\Psr7\RequestFactory as HttpRequestFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Serialize\Serializer\Json as JsonSerializer;
use Magento\Store\Model\StoreManager;
use Psr\Log\LoggerInterface as Logger;
use Ccastro\Frenet\Model\Api\Endpoint;
use Ccastro\Frenet\Model\FrenetRequest;
use Exception;

class Quote
{
    /**
     * Url Stub Prefix of this API endpoint
     */
    const URL_STUB_PREFIX = 'shipping/quote';

    /**
     * @var Auth
     */
    private $auth;

    /**
     * @var HttpClientFactory
     */
    private $httpClientFactory;

    /**
     * @var HttpRequestFactory
     */
    private $httpRequestFactory;

    /**
     * @var JsonSerializer
     */
    private $jsonSerializer;

    /**
     * @var Logger|null
     */
    private $logger = null;

    /**
     * @var StoreManager
     */
    private $storeManager;

    /**
     * @var Endpoint
     */
    private $endpoint;

    /**
     * Quote constructor.
     * @param Auth $auth
     * @param HttpClientFactory $httpClientFactory
     * @param HttpRequestFactory $httpRequestFactory
     * @param JsonSerializer $jsonSerializer
     * @param Logger $logger
     * @param StoreManager $storeManager
     * @param Endpoint $endpoint
     */
    public function __construct(
        Auth $auth,
        HttpClientFactory $httpClientFactory,
        HttpRequestFactory $httpRequestFactory,
        JsonSerializer $jsonSerializer,
        Logger $logger,
        StoreManager $storeManager,
        Endpoint $endpoint
    ) {
        $this->auth = $auth;
        $this->httpClientFactory = $httpClientFactory;
        $this->httpRequestFactory = $httpRequestFactory;
        $this->jsonSerializer = $jsonSerializer;
        $this->logger = $logger;
        $this->storeManager = $storeManager;
        $this->endpoint = $endpoint;
    }

    /**
     * Retrieve shipping information (carriers)
     * @param string $requestString
     * @return array
     * @throws NoSuchEntityException
     */
    public function execute(FrenetRequest $request)
    {
        $return = [];
        $storeId = $this->getCurrentStoreId();

        /** @var HttpClient $client */
        $client = $this->httpClientFactory->create();
        $url = $this->endpoint->get(self::URL_STUB_PREFIX);

        try {
            $response = $client->post(
                $url,
                [
                    'headers' => $this->auth->getAuthHeaders($storeId),
                    'body' => $this->jsonSerializer->serialize($request->getData())
                ]
            );

            if ((int) $response->getStatusCode() === 200) {
                $this->logger->info('Success fetching rates: ' . $response->getBody());
                $return = (string) $response->getBody();
            } else {
                $this->logger->info('Failed -> Body: ' . $response->getBody());
            }
        } catch (Exception $e) {
            $this->logger->info('Failed: ' . $e->getMessage());
        }

        return $return;
    }

    /**
     * Returns the ID of the current store
     * @return int
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    private function getCurrentStoreId()
    {
        return $this->storeManager->getStore()->getId();
    }
}
