<?php

namespace Azzarip\Keap;

use Illuminate\Support\Facades\Cache;

class Token
{
    protected $client;
    public function __construct()
    {
        $this->client = new Client();
    }

    public function request(string $code)
    {
        $response = $this->client->post('/token', [
            'client_id' => config('keap.client_key'),
            'client_secret' => config('keap.client_secret'),
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => url('/keap/callback'),
        ]);

        $this->cacheResponse($response);
    }

    public function refresh()
    {
        $response = $this->client->auth()->post('/token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => Cache::get('keap.refresh_token'),
        ]);

        $this->cacheResponse($response);

    }

    protected function cacheResponse($response)
    {
        Cache::put('keap.access_token', $response['access_token'], $response['expires_in'] - 1);
        Cache::put('keap.refresh_token', $response['refresh_token'], $response['expires_in'] - 1);
    }

    public function check(): bool
    {
        return (Cache::has('keap.access_token') && Cache::has('keap.refresh_token'));
    }
}
