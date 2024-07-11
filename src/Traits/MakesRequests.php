<?php

namespace KeapGeek\Keap\Traits;

use Illuminate\Support\Facades\Cache;

trait MakesRequests
{
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
