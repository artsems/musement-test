<?php

namespace Musement\Rest;

use Psr\Http\Message\ResponseInterface;

interface ApiClientInterface
{
    /**
     * @param string   $uri
     * @param string[] $parameters
     *
     * @return ResponseInterface|null
     */
    public function request(string $uri, array $parameters = []): ?ResponseInterface;
}
