<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

beforeEach(function() {
    Cache::put('keap.access_token', 'old_access_token', 100);
    Cache::put('keap.refresh_token', 'olde_refresh_token', 100);
    Http::fake([
        'https://api.infusionsoft.com/token' => Http::response([
            "access_token"=> 'new_access_token',
            "refresh_token"=> 'new_refresh_token',
            "expires_in" => 100
    ], 200)]);
});

it('fails if no value is cached', function() {
    $this->artisan('cache:clear');
    $this->artisan('keap:refresh')->assertExitCode(1);
});



it('stores refresh and access token in cache', function() {
    $this->artisan('keap:refresh');
    expect(Cache::has('keap.access_token'))->toBeTrue();
    expect(Cache::has('keap.refresh_token'))->toBeTrue();
    expect(Cache::get('keap.access_token'))->toBe('new_access_token');
    expect(Cache::get('keap.refresh_token'))->toBe('new_refresh_token');
});
