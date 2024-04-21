<?php

namespace Azzarip\Keap\Services;

use Azzarip\Keap\Client;
use Azzarip\Keap\Exceptions\InvalidTokenException;

class Service
{
    protected $client;

    protected $uri = '';

    public function __construct()
    {
        if (! Token::check()) {
            throw new InvalidTokenException('Access Token is Missing: go to /keap/auth');
        }

        $this->client = new Client(Token::getToken());

        $this->client->setUri($this->uri);
    }
}
