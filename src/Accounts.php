<?php

namespace RevolutPHP;

class Accounts
{
    const ENDPOINT = 'accounts';

    /**
     * @var Client
     */
    private $client;

    /**
     * Account constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @see https://revolutdev.github.io/business-api/#get-accounts
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function all()
    {
        return $this->client->get(self::ENDPOINT);
    }

    /**
     * @see https://revolutdev.github.io/business-api/#get-account
     *
     * @param string $id
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $id)
    {
        return $this->client->get(self::ENDPOINT.'/'.$id);
    }

    /**
     * @see https://revolutdev.github.io/business-api/#get-account-details
     *
     * @param string $id
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDetails(string $id)
    {
        return $this->client->get(self::ENDPOINT.'/'.$id.'/bank-details');
    }
}
