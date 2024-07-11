<?php

namespace KeapGeek\Keap\Services;

use Illuminate\Support\Carbon;
use KeapGeek\Keap\Client;
use KeapGeek\Keap\Exceptions\InvalidTokenException;
use KeapGeek\Keap\Token;
use KeapGeek\Keap\Traits\MakesRequests;

class Service
{
    use MakesRequests;

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

    protected function parseDatetime(string $field, array &$data)
    {
        if (array_key_exists($field, $data)) {
            $data[$field] = Carbon::parse($data[$field])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }
    }

    protected function parseDate(string $field, array &$data)
    {
        if (array_key_exists($field, $data)) {
            $data[$field] = Carbon::parse($data[$field])->setTimezone('UTC')->format('Y-m-d');
        }
    }

    protected function encode64(string $field, array &$data)
    {
        if (array_key_exists($field, $data)) {
            $data[$field] = base64_encode($data[$field]);
        }
    }

    protected function switch(string $from, string $to, array &$data)
    {
        if (array_key_exists($from, $data)) {
            $data[$to] = $data[$from];
            unset($data[$from]);
        }
    }
}
