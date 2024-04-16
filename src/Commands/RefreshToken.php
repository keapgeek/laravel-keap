<?php

namespace Azzarip\Keap\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class RefreshToken extends Command
{
    public $signature = 'keap:refresh';

    public $description = 'Refresh Keap access and refresh tokens.';

    public function handle(): int
    {
        if(! Cache::has('keap.access_token') || ! Cache::has('keap.refresh_token')) {
            $this->error('Access and refresh tokens not found in cache. Please login at /keap/auth');
            return self::FAILURE;
        }

        $response = \Illuminate\Support\Facades\Http::asForm()
            ->withBasicAuth(config('keap.client_key'), config('keap.client_secret'))
            ->post('https://api.infusionsoft.com/token',
        [
            'grant_type' => 'refresh_token',
            'refresh_token' => Cache::get('keap.refresh_token'),
        ]);

        $data = $response->getBody()->getContents();
        $data = json_decode($data, true);

        Cache::put('keap.access_token', $data['access_token'], $data['expires_in'] - 1);
        Cache::put('keap.refresh_token', $data['refresh_token'], $data['expires_in'] - 1);

        $this->info('Successfully refreshed access and refresh tokens.');
        return self::SUCCESS;
    }
}
