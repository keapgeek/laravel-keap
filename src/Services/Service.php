<?php

namespace KeapGeek\Keap\Services;

use KeapGeek\Keap\Token;
use KeapGeek\Keap\Client;
use Illuminate\Support\Carbon;
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

        $this->client = new Client(Token::getAccessToken());

        $this->client->setUri($this->uri);
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    protected function parseDate(string $field, array &$data)
    {
        if (array_key_exists($field, $data)) {
            $data[$field] = Carbon::parse($data[$field])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }
    }

    protected function encode64(string $field, array &$data)
    {
        if (array_key_exists($field, $data)) {
            $data[$field] = base64_encode($data[$field]);
        }
    }
}
