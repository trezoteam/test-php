<?php

namespace Walisson\TrezoShippingTest\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Helper\AbstractHelper;
use Walisson\TrezoShippingTest\Api\Data\ConfigInterface;
use Walisson\TrezoShippingTest\Helper\Config;

/**
 * Class Provider
 *
 * @package Walisson\TrezoShippingTest\Helper
 */
class Provider extends AbstractHelper
{
    /** @var mixed */
    protected $apiToken;

    /** @var mixed */
    protected $apiUrl;

    /** @var Config */
    protected $configHelper;

    /**
     * Provider constructor.
     *
     * @param Context $context
     * @param Config $config
     */
    public function __construct(
        Context $context,
        Config $config
    ) {
        $this->configHelper = $config;
        parent::__construct($context);
        $this->apiToken = $this->configHelper->getValue(Config::API_TOKEN);
        $this->apiUrl = $this->configHelper->getValue(Config::API_URL);
    }

    /**
     * Makes a POST request to the API.
     *
     * @param $endpoint
     * @param $params
     * @return false|string
     */
    public function postApi($endpoint, $params)
    {
        $headers = [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($params),
            'Authorization: ' . $this->apiToken
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $output = curl_exec($ch);
        $info = curl_getinfo($ch);
        $statusCode = $info['http_code'];

        curl_close($ch);

        return $this->responseStatusCode($statusCode, $output);
    }

    /**
     * Generate the response structure
     *
     * @param $statusCode
     * @param $output
     * @return false|string
     */
    private function responseStatusCode($statusCode, $output)
    {
        try {
            $outputArray = json_decode($output, true);
            $outputArray['error'] = false;
            $outputArray['status_code'] = $statusCode;
            if ($statusCode != 200) {
                $outputArray['error'] = true;
                $outputArray['error_message'] = __('Something went wrong over the API request.');
            }
        } catch (LocalizedException $e) {
            $outputArray = ['error' => true, 'error_message' => __('Something went wrong over the API request.')];
            $outputArray['status_code'] = 404;

        }
        return json_encode($outputArray);
    }
}