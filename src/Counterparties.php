<?php

namespace RevolutPHP;

class Counterparties
{
    const ENDPOINT = 'counterparty';

    /**
     * @var Client
     */
    private $client;

    /**
     * Counterparties constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @see https://revolutdev.github.io/business-api/#get-counterparties
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function all()
    {
        return $this->client->get('counterparties');
    }

    /**
     * @see https://revolutdev.github.io/business-api/#get-counterparty
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
     * @see https://revolutdev.github.io/business-api/#add-revolut-counterparty
     * @see https://revolutdev.github.io/business-api/#add-non-revolut-counterparty
     *
     * @param array $json
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(array $json)
    {
        return $this->client->post(self::ENDPOINT, $json);
    }

    /**
     * @see https://revolutdev.github.io/business-api/#delete-counterparty
     *
     * @param $id
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($id)
    {
        return $this->client->delete(self::ENDPOINT.'/'.$id);
    }
}
