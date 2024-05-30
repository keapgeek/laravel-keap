<?php

use KeapGeek\Keap\Facades\Keap;
use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Services\Setting;

beforeEach(function () {
    setTokens();
    Http::fake();
});

test('facade returns a Setting Service', function () {
    expect(Keap::setting())->toBeInstanceOf(Setting::class);
});


test('status makes a GET request', function () {
    Keap::setting()->status();

    Http::assertSent(function ($request) {
       return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/setting/application/enabled' &&
              $request->method() === 'GET';
    });
});

test('config makes a GET request', function () {
    Keap::setting()->config();

    Http::assertSent(function ($request) {
       return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/setting/application/configuration' &&
              $request->method() === 'GET';
    });
});
