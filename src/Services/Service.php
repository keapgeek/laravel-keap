<?php

namespace KeapGeek\Keap\Services;

use KeapGeek\Keap\Client;
use KeapGeek\Keap\Exceptions\InvalidTokenException;

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
