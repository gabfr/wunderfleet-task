<?php

namespace App\Services;

use GuzzleHttp\Client;

abstract class BaseService
{
    /**
     * @var Client
     */
    public $client;

    /**
     * The method that defines the base uri of this service
     * @return string
     */
    abstract public function baseUri(): string;

    /**
     * PaymentDataService constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $method
     * @param $uri
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request($method, $uri, $options = [])
    {
        $options['base_uri'] = $this->baseUri();
        return $this->client->request($method, $uri, $options);
    }

}
