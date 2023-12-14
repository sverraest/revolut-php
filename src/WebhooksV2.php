<?php

namespace RevolutPHP;

class WebhooksV2
{
    const ENDPOINT = '2.0/webhooks';

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
     * @see https://developer.revolut.com/docs/business/create-webhook
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
     * @see https://developer.revolut.com/docs/business/get-webhooks
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function all()
    {
        return $this->client->get(self::ENDPOINT);
    }

    /**
     * @see https://developer.revolut.com/docs/business/get-webhook
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
     * @see https://developer.revolut.com/docs/business/update-webhook
     *
     * @param string $id
     * @param array $json
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update(string $id, array $json)
    {
        return $this->client->patch(self::ENDPOINT.'/'.$id, $json);
    }

    /**
     * @see https://developer.revolut.com/docs/business/delete-webhook
     *
     * @param string $id
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(string $id)
    {
        return $this->client->delete(self::ENDPOINT.'/'.$id);
    }

    /**
     * @see https://developer.revolut.com/docs/business/rotate-webhook-signing-secret
     *
     * @param string $id
     * @param array $json
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function rotateSigningSecret(string $id, array $json)
    {
        return $this->client->post(self::ENDPOINT.'/'.$id.'/rotate-signing-secret', $json);
    }

    /**
     * @see https://developer.revolut.com/docs/business/failed-events
     *
     * @param string $id
     * @param int|null $limit
     * @param \DateTime|null $createdBefore
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getFailedEvents(string $id, int $limit = null, \DateTime $createdBefore = null)
    {
        $args = [];
        if (null !== $limit) {
            $args['limit'] = $limit;
        }
        if (null !== $limit) {
            $args['created_before'] = $createdBefore->format(\DateTime::ISO8601);
        }

        $query = http_build_query($args);

        $endpoint = self::ENDPOINT.'/'.$id.'/failed-events';
        $endpoint = implode('?', array_filter([$endpoint, $query]));

        return $this->client->get($endpoint);
    }
}
