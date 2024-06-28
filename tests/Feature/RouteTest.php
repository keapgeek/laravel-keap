<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

use function Pest\Laravel\get;

beforeEach(function () {
    $this->access_token = 'access_token';
    $this->refresh_token = 'refresh_token';
    Http::fake([
        'https://api.infusionsoft.com/token' => Http::response([
            'access_token' => $this->access_token,
            'refresh_token' => $this->refresh_token,
            'expires_in' => 100,
        ], 200)]);

});

it('routes are protected by middleware', function () {
    $r = app()['router'];
    $route = $r->getRoutes()->getRoutesByMethod('GET')['GET']['keap/auth'];
    expect($route->getAction()['middleware'])->toBe(['web']);
    get('/keap/auth')->assertRedirect();
});

it('redirects to Auth Server with Parameters', function () {
    $url = 'https://accounts.infusionsoft.com/app/oauth/authorize?';
    $url .= Arr::query([
        'client_id' => '0123456789',
        'redirect_uri' => 'http://localhost/keap/callback',
        'response_type' => 'code',
        'scope' => 'full',
    ]);
    get('/keap/auth')->assertRedirect(urldecode($url));
});

it('receives callback', function () {
    get('/keap/callback?&code=callback_code')->assertOk();
});

it('stores refresh and access token in cache', function () {
    get('/keap/callback?&code=callback_code');
    expect(Cache::has('keap.access_token'))->toBeTrue();
    expect(Cache::has('keap.refresh_token'))->toBeTrue();
    expect(Cache::get('keap.access_token'))->toBe($this->access_token);
    expect(Cache::get('keap.refresh_token'))->toBe($this->refresh_token);
});
it('returns error if callback code is missing', function () {
    get('/keap/callback')->assertSee('Missing callback code');
});
