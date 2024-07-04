<?php

namespace KeapGeek\Keap\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
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


    protected function get($uri = '/', array $data = [])
    {
        $url = $this->client->getUrl().'/'.ltrim($uri, '/');
        $cacheKey = 'http_get_'.md5($url.json_encode($data));

        return Cache::remember($cacheKey, config('keap.cache_duration', 60), function () use ($uri, $data) {
            return $this->client->call('get', $uri, $data);
        });
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
