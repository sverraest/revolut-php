<?php

namespace RevolutPHP;

class Webhooks
{
    const ENDPOINT = 'webhook';

    /**
     * @var Client
     */
    private $client;

    /**
     * Webhook constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @see https://revolutdev.github.io/business-api/#web-hooks
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
