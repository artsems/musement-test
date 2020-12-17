<?php

namespace Musement\Tools;

use Psr\Http\Message\ResponseInterface;

class Fetcher
{
    public static function fetchCities(ResponseInterface $response): array
    {
        $array = $response->getBody()->getContents();
        $array = json_decode($array, true);
        $array = array_map(function (array $city): array {
            return [
                'name'      => $city['name'],
                'latitude'  => $city['latitude'],
                'longitude' => $city['longitude'],
            ];
        }, $array);

        return $array;
    }
}