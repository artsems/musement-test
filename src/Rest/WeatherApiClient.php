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
    private string $apiKey;

    public function __construct()
    {
        parent::__construct();

        $this->baseUri = getenv('WEATHER_API_BASE_URI') ?: 'http://api.weatherapi.com';
        $this->apiKey  = getenv('WEATHER_API_KEY') ?: '0703b9dc9b3c48868d7212338201712';
    }

    /**
     * @param string   $uri
     * @param string[] $parameters
     *
     * @return ResponseInterface|null
     */
    public function request(string $uri, array $parameters = []): ?ResponseInterface
    {
        try {
            return $this->client->get($this->baseUri . $uri);
        } catch (GuzzleException $guzzleException) {
            Printer::error($guzzleException->getMessage(), 'GUZZLE ERROR');

            return null;
        }
    }

    /**
     * @param array[] $cities
     *
     * @return string[]
     */
    public function forecast2d(array $cities): array
    {
        $uri  = "{$this->baseUri}/v1/forecast.json";
        $uri .= "?key={$this->apiKey}";
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
