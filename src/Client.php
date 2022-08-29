<?php

namespace RevolutPHP;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response;
use League\OAuth2\Client\Token\AccessToken;
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
     * @var \League\OAuth2\Client\Token\AccessToken
     */
    private $accessToken;

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
     * @var PaymentDrafts
     */
    public $paymentDrafts;

    /**
     * @var Transactions
     */
    public $transactions;

    /**
     * @var Rates
     */
    public $rates;

    /**
     * @var Exchanges
     */
    public $exchanges;

    /**
     * @var Webhooks
     */
    public $webhooks;

    /**
     * Client constructor.
     * @param AccessToken $accessToken
     * @param string $mode
     * @param array $clientOptions
     */
    public function __construct(AccessToken $accessToken, $mode = 'production', array $clientOptions = [])
    {
        $this->accessToken = $accessToken;
        $this->mode = $mode;
        $this->baseUrl = ($mode === 'production' ? self::REVOLUT_PRODUCTION_ENDPOINT : self::REVOLUT_SANDBOX_ENDPOINT);
        $this->clientOptions = $clientOptions;

        $this->initiateHttpClient();

        $this->accounts = new Accounts($this);
        $this->counterparties = new Counterparties($this);
        $this->payments = new Payments($this);
        $this->paymentDrafts = new PaymentDrafts($this);
        $this->transfers = new Transfers($this);
        $this->transactions = new Transactions($this);
        $this->rates = new Rates($this);
        $this->exchanges = new Exchanges($this);
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
                'Authorization' => 'Bearer ' . $this->accessToken->getToken(),
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
        $stream = $response->getBody();
        $data = json_decode($stream);

        return $data;
    }

    /**
     * @param string $endpoint
     * @param array $json
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post($endpoint, $json)
    {
        $response = $this->httpClient->request('POST', $this->buildBaseUrl().$endpoint, ['json' => $json]);
        return $this->handleResponse($response);
    }

    /**
     * @param string $endpoint
     * @param array $json
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function patch($endpoint, $json)
    {
        $response = $this->httpClient->request('PATCH', $this->buildBaseUrl().$endpoint, ['json' => $json]);
        return $this->handleResponse($response);
    }

    /**
     * @param string $endpoint
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($endpoint)
    {
        $response = $this->httpClient->request('GET', $this->buildBaseUrl().$endpoint);
        return $this->handleResponse($response);
    }

    /**
     * @param string $endpoint
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($endpoint)
    {
        $response = $this->httpClient->request('DELETE', $this->buildBaseUrl().$endpoint);
        return $this->handleResponse($response);
    }
}
