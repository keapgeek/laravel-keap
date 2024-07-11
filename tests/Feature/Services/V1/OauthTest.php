<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V1\Oauth;

beforeEach(function () {
    setTokens();
    Http::fake();
});

test('facade returns a Oauth Service', function () {
    expect(Keap::oauth())->toBeInstanceOf(Oauth::class);
});

test('info makes a GET request', function () {
    Keap::oauth()->user();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/oauth/connect/userinfo' &&
               $request->method() === 'GET';
    });
});
