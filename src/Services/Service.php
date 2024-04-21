<?php

namespace Azzarip\Keap\Services;

use Azzarip\Keap\Client;

class Service
{
    protected $client;

    protected $uri = '';

    public function __construct()
    {
        $this->client = new Client(Token::getToken());

        $this->client->setUri($this->uri);
    }
}
