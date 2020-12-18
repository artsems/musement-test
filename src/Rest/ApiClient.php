<?php

namespace Musement\Rest;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

abstract class ApiClient implements ApiClientInterface
{
    protected Client $client;

    protected string $baseUri;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param string   $uri
     * @param string[] $parameters
     *
     * @return ResponseInterface|null
     */
    abstract public function request(string $uri, array $parameters = []): ?ResponseInterface;
}
