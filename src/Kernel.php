<?php

namespace Musement;

use Musement\Rest\MusementApiClient;
use Musement\Rest\WeatherApiClient;
use Musement\Tools\Fetcher;
use Musement\Tools\Printer;
use Psr\Http\Message\ResponseInterface;

class Kernel
{
    public function handle()
    {
        $cities   = $this->cities();
        $weathers = $this->weathers($cities);

        foreach ($weathers as $weather) {
            Printer::message($weather);
        }
    }

    public function cities(): array
    {
        $cities = (new MusementApiClient())->request('/v3/cities');

        if ($cities instanceof ResponseInterface) {
            return Fetcher::fetchCities($cities);
        }

        return [];
    }

    public function weathers(array $cities): array
    {
        if (empty($cities)) {
            return [];
        }

        return (new WeatherApiClient())->forecast2d($cities);
    }
}
