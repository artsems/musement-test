<?php

namespace Musement\Rest;

use GuzzleHttp\Exception\GuzzleException;
use Musement\Tools\Printer;
use Psr\Http\Message\ResponseInterface;

class MusementApiClient extends ApiClient
{
    public function __construct()
    {
        parent::__construct();

        $this->baseUri = getenv('MUSEMENT_API_BASE_URI') ?: 'https://api.musement.com/api';
    }

    public function request(string $uri, array $parameters = []): ?ResponseInterface
    {
        try {
            return $this->client->get($this->baseUri . $uri);
        } catch (GuzzleException $guzzleException) {
            Printer::error($guzzleException->getMessage(), 'GUZZLE ERROR');

            return null;
        }
    }
}