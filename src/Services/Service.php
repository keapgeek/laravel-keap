<?php

namespace Azzarip\Keap\Services;

use Azzarip\Keap\Client;
use Azzarip\Keap\InvalidTokenException;
use Azzarip\Keap\Services\TokenService;

class Service
{
    protected $client;

    protected $uri = '';
    public function __construct()
    {
        if(!TokenService::check())
        {
            throw new InvalidTokenException();
        }

        $this->client = new Client(TokenService::getToken());

        $this->client->setUri($this->uri);
    }

}
