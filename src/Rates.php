<?php

namespace RevolutPHP;

class Rates
{
    const ENDPOINT = '1.0/rate';

    /**
     * @var Client
     */
    private $client;

    /**
     * Rates constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @see https://revolutdev.github.io/business-api/#get-exchange-rates
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $from, string $to, float $amount)
    {
        $params = ['from' => $from, 'to' => $to, 'amount' => $amount];
        return $this->client->get(self::ENDPOINT.'?'.http_build_query($params));
    }
}
