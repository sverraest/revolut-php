<?php

namespace RevolutPHP;

class Exchanges
{
    const ENDPOINT = '1.0/exchange';

    /**
     * @var Client
     */
    private $client;

    /**
     * Exchanges constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @see https://revolutdev.github.io/business-api/#exchange-currency
     *
     * @param array $json
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function exchange(array $json)
    {
        return $this->client->post(self::ENDPOINT, $json);
    }
}
