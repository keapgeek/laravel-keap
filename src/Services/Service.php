<?php

namespace KeapGeek\Keap\Services;

use Illuminate\Support\Carbon;
use KeapGeek\Keap\Client;
use KeapGeek\Keap\Exceptions\InvalidTokenException;
use KeapGeek\Keap\Token;

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

    protected function get($uri = '/', array $data = [])
    {
        return $this->client->call('get', $uri, $data);
    }

    protected function post($uri, $data)
    {
        return $this->client->call('post', $uri, $data);
    }

    protected function put($uri, $data)
    {
        return $this->client->call('put', $uri, $data);
    }

    protected function del($uri, $data = null)
    {
        return $this->client->call('delete', $uri, $data);
    }

    protected function patch($uri, $data)
    {
        return $this->client->call('patch', $uri, $data);
    }
}
