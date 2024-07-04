<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\Locale;

beforeEach(function () {
    setTokens();
});

test('facade returns a Locale Service', function () {
    expect(Keap::locale())->toBeInstanceOf(Locale::class);
});

test('countries makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['countries' => []], 200),
    ]);

    Keap::locale()->countries();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/locales/countries' &&
               $request->method() === 'GET';
    });
});

test('provinces makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['provinces' => []], 200),
    ]);

    Keap::locale()->provinces('XXX');

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/locales/countries/XXX/provinces' &&
               $request->method() === 'GET';
    });
});

test('dropdown makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['contact_types' => []], 200),
    ]);

    Keap::locale()->dropdown('contact');

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/locales/defaultOptions' &&
               $request->method() === 'GET';
    });
});
