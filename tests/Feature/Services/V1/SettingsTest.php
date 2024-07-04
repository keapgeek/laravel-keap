<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V1\Settings;

beforeEach(function () {
    setTokens();
});

test('facade returns a Settings Service', function () {
    expect(Keap::settings())->toBeInstanceOf(Settings::class);
});

test('status makes a GET request', function () {
    Http::fake([
        'api.infusionsoft.com/*' => Http::response([
            'value' => 'yes',
        ], 200),
    ]);

    Keap::settings()->status();

    Http::assertSent(function ($request) {

        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/setting/application/enabled' &&
               $request->method() === 'GET';
    });
});

test('config makes a GET request', function () {
    Http::fake();
    Keap::settings()->config();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/setting/application/configuration' &&
               $request->method() === 'GET';
    });
});
