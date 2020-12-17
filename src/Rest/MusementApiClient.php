<?php

namespace Musement\Rest;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Musement\Tools\Printer;
use Psr\Http\Message\ResponseInterface;

class MusementApiClient extends ApiClient
{
    // TODO: move to dotenv
    public const BASE_URI = 'https://api.musement.com/api';

    public function request(string $uri): ?ResponseInterface
    {
        try {
            return $this->client->get(self::BASE_URI . $uri);
        } catch (GuzzleException $guzzleException) {
            Printer::error($guzzleException->getMessage(), 'GUZZLE ERROR');
        } catch (Exception $exception) {
            Printer::error($exception->getMessage(), 'MUSEMENT API ERROR');
        }

        return null;
    }
}