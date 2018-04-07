<?php

namespace RevolutPHP;

class Transactions
{
    const ENDPOINT = 'transaction';

    /**
     * @var Client
     */
    private $client;

    /**
     * Payments constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @see https://revolutdev.github.io/business-api/#get-transactions
     *
     * @param array $filters
     * @return mixed
     */
    public function all($filters = [])
    {
        return $this->client->get('transactions?'.http_build_query($filters));
    }

    /**
     * @see https://revolutdev.github.io/business-api/#cancel-payment
     *
     * @param $id
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function cancel($id)
    {
        return $this->client->delete(self::ENDPOINT.'/'.$id);
    }

    /**
     * @see https://revolutdev.github.io/business-api/#check-payment-status
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
     * @see https://revolutdev.github.io/business-api/#check-payment-status
     *
     * @param string $requestId
     * @return mixed
     */
    public function getByRequestId(string $requestId)
    {
        $query = ['id_type' => 'request_id'];
        return $this->client->get(self::ENDPOINT.'/'.$requestId.'?'.http_build_query($query));
    }
}
