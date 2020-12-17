<?php

namespace Musement\Rest;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Musement\Tools\Printer;
use Psr\Http\Message\ResponseInterface;

class WeatherApiClient extends ApiClient
{
    // TODO: move to dotenv
    private const BASE_URI = 'http://api.weatherapi.com';
    private const API_KEY  = '0703b9dc9b3c48868d7212338201712';

    public function request(string $uri, array $parameters = []): ?ResponseInterface
    {
        try {
            return $this->client->get(self::BASE_URI . $uri);
        } catch (GuzzleException $guzzleException) {
            Printer::error($guzzleException->getMessage(), 'GUZZLE ERROR');

            return null;
        }
    }

    public function forecast2d(array $cities): array
    {
        $uri  = self::BASE_URI . '/v1/forecast.json';
        $uri .= '?key=' . self::API_KEY;
        $uri .= '&days=2';

        $requests = function ($cities) use ($uri) {
            foreach ($cities as $city) {
                yield new Request('GET', "{$uri}&q={$city['latitude']},{$city['longitude']}");
            }
        };

        $forecast = [];

        $pool = new Pool($this->client, $requests($cities), [
            'concurrency' => 10,

            'fulfilled' => function (Response $response, $index) use ($cities, &$forecast) {
                $array = $response->getBody()->getContents();
                $array = json_decode($array, true);

                $today    = $array['forecast']['forecastday'][0]['day']['condition']['text'];
                $tomorrow = $array['forecast']['forecastday'][1]['day']['condition']['text'];

                $forecast[$index] = "Processed city {$cities[$index]['name']} | {$today} - {$tomorrow}.";
            },

            'rejected' => function (RequestException $exception, $index) use ($cities, &$forecast) {
                $forecast[$index] = "Processed city {$cities[$index]['name']} | {$exception->getMessage()}.";
            },
        ]);

        $promise = $pool->promise();
        $promise->wait();

        return $forecast;
    }
}