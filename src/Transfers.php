<?php

namespace RevolutPHP;

class Transfers
{
    const ENDPOINT = 'transfer';

    /**
     * @var Client
     */
    private $client;

    /**
     * Transfers constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @see https://revolutdev.github.io/business-api/#transfer
     *
     * @param array $json
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(array $json)
    {
        return $this->client->post(self::ENDPOINT, $json);
    }
}
