<?php

namespace Ccastro\Frenet\Model\Api;

/**
 * Class Endpoint
 * @package Ccastro\Frenet\Model\Api
 */
class Endpoint
{
    /**
     * Frenet api endpoint
     */
    const FRENET_API_BASE_ENDPOINT = 'http://api.frenet.com.br/';

    /**
     * API endpoint with the specified url stub.
     * @param string $urlStub
     * @return string
     */
    public function get($urlStub)
    {
        return self::FRENET_API_BASE_ENDPOINT . $urlStub;
    }
}
