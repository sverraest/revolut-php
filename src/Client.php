<?php

namespace RevolutPHP;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class Client
{

    const REVOLUT_API_VERSION = '1.0';
    const REVOLUT_SANDBOX_ENDPOINT = 'https://sandbox-b2b.revolut.com/api/';
    const REVOLUT_PRODUCTION_ENDPOINT = 'https://b2b.revolut.com/api/';

    /**
     * @var \GuzzleHttp\Client
     */
    private $httpClient;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $mode;

    /**
     * @var array
     */
    private $clientOptions;

    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @var Accounts
     */
    public $accounts;

    /**
     * @var Counterparties
     */
    public $counterparties;

    /**
     * @var Transfers
     */
    public $transfers;

    /**
     * @var Payments
     */
    public $payments;

    /**
     * @var Transactions
     */
    public $transactions;

    /**
     * @var Webhooks
     */
    public $webhooks;

    /**
     * Client constructor.
     * @param string $apiKey
     * @param string $mode
     * @param array $clientOptions
     */
    public function __construct(string $apiKey, $mode = 'production', array $clientOptions = [])
    {
        $this->apiKey = $apiKey;
        $this->mode = $mode;
        $this->baseUrl = ($mode === 'production' ? self::REVOLUT_PRODUCTION_ENDPOINT : self::REVOLUT_SANDBOX_ENDPOINT);
        $this->clientOptions = $clientOptions;

        $this->initiateHttpClient();

        $this->accounts = new Accounts($this);
        $this->counterparties = new Counterparties($this);
        $this->payments = new Payments($this);
        $this->transfers = new Transfers($this);
        $this->transactions = new Transactions($this);
        $this->webhooks = new Webhooks($this);
    }

    /**
     * @param GuzzleClient $client
     */
    public function setClient(GuzzleClient $client)
    {
        $this->httpClient = $client;
    }

    /**
     * Initiates the HttpClient with required headers
     */
    private function initiateHttpClient()
    {
        $options = [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
            ]
        ];

        $this->httpClient = new GuzzleClient(array_replace_recursive($this->clientOptions, $options));
    }

    private function buildBaseUrl()
    {
        return $this->baseUrl.self::REVOLUT_API_VERSION.'/';
    }

    /**
     * @param Response $response
     * @return mixed
     */
    private function handleResponse(Response $response)
    {
        $stream = \GuzzleHttp\Psr7\stream_for($response->getBody());
        $data = json_decode($stream);

        return $data;
    }

    /**
     * @param $endpoint
     * @param $json
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post($endpoint, $json)
    {
        $response = $this->httpClient->request('POST', $this->buildBaseUrl().$endpoint, ['json' => $json]);
        return $this->handleResponse($response);
    }

    /**
     * @param $endpoint
     * @return mixed
     */
    public function get($endpoint)
    {
        $response = $this->httpClient->request('GET', $this->buildBaseUrl().$endpoint);
        return $this->handleResponse($response);
    }

    /**
     * @param $endpoint
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($endpoint)
    {
        $response = $this->httpClient->request('DELETE', $this->buildBaseUrl().$endpoint);
        return $this->handleResponse($response);
    }
}
