<?php

namespace Walisson\TrezoShippingTest\Api\Data;

/**
 * Interface ConfigInterface
 *
 * @package Walisson\TrezoShippingTest\Api\Data
 */
interface ConfigInterface
{
    const METHOD_CODE = 'trezoshippingtest';
    const BASE_PATH = 'carriers/trezoshippingtest/';
    const ACTIVE = self::BASE_PATH . 'active';
    const NAME = self::BASE_PATH . 'name';
    const TITLE = self::BASE_PATH . 'title';
    const DELIVERY_ADDITIONAL_DAYS = self::BASE_PATH . 'delivery_additional_days';
    const API_URL = self::BASE_PATH . 'api_url';
    const API_KEY = self::BASE_PATH . 'api_key';
    const API_PASS = self::BASE_PATH . 'api_pass';
    const API_TOKEN = self::BASE_PATH . 'api_token';

    /**
     * Return the config value by current website id
     *
     * @param $value
     * @return mixed
     */
    public function getValue($value);
}