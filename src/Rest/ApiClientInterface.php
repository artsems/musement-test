<?php

namespace Musement\Rest;

use Psr\Http\Message\ResponseInterface;

interface ApiClientInterface
{
    public function request(string $uri, array $parameters = []): ?ResponseInterface;
}
