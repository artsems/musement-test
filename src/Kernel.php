<?php

namespace Musement;

use Musement\Rest\MusementApiClient;
use Musement\Tools\Fetcher;

class Kernel
{
    public function handle()
    {
        $musementClient = new MusementApiClient();

        $cities = $musementClient->request('/v3/cities');
        $cities = Fetcher::fetchCities($cities);
    }
}