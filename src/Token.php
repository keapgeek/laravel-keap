<?php

namespace KeapGeek\Keap;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Token
{
    public static function request(string $code)
    {
        $response = Http::asForm()
            ->retry(config('keap.retry_times'), config('keap.retry_delay'))
            ->post('https://api.infusionsoft.com/token', [
                'client_id' => config('keap.client_key'),
                'client_secret' => config('keap.client_secret'),
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => url('/keap/callback'),
            ]);

        self::cacheResponse($response);
    }

    public static function refresh()
    {
        $response = Http::asForm()
            ->retry(config('keap.retry_times'), config('keap.retry_delay'))
            ->withBasicAuth(config('keap.client_key'), config('keap.client_secret'))
            ->post('https://api.infusionsoft.com/token', [
                'grant_type' => 'refresh_token',
                'refresh_token' => Cache::get('keap.refresh_token'),
            ]);

        self::cacheResponse($response);
    }

    protected static function cacheResponse($response)
    {
        Cache::put('keap.access_token', $response['access_token'], $response['expires_in'] - 1);
        Cache::put('keap.refresh_token', $response['refresh_token'], $response['expires_in'] - 1);
    }

    public static function check(): bool
    {
        return Cache::has('keap.access_token') && Cache::has('keap.refresh_token');
    }

    public static function getAccessToken(): string
    {
        return Cache::get('keap.access_token');
    }
}
