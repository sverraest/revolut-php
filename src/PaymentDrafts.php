<?php

namespace RevolutPHP;

class PaymentDrafts
{
    const ENDPOINT = 'payment-drafts';

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
     * @see https://revolut-engineering.github.io/api-docs/#business-api-business-api-payment-drafts-create-a-payment-draft
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
     * @see https://revolut-engineering.github.io/api-docs/#business-api-get-payment-drafts
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function all()
    {
        return $this->client->get(self::ENDPOINT);
    }

    /**
     * @see https://revolut-engineering.github.io/api-docs/#business-api-business-api-get-payment-drafts-get-payment-draft-by-id
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
     * @see https://revolut-engineering.github.io/api-docs/#business-api-business-api-get-payment-drafts-delete-payment-draft
     *
     * @param string $id
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($id)
    {
        return $this->client->delete(self::ENDPOINT.'/'.$id);
    }
}
