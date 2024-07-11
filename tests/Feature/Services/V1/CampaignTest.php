<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V1\Campaign;

beforeEach(function () {
    setTokens();
});

test('facade returns a Campaign Service', function () {
    expect(Keap::campaign())->toBeInstanceOf(Campaign::class);
});

test('list makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['campaigns' => []], 200),
    ]);
    Keap::campaign()->list();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/campaigns' &&
               $request->method() === 'GET';
    });
});

test('count makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['count' => []], 200),
    ]);
    Keap::campaign()->count();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/campaigns' &&
               $request->method() === 'GET';
    });
});

test('find makes a GET request', function () {
    Http::fake();

    Keap::campaign()->find(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/campaigns/1' &&
               $request->method() === 'GET';
    });
});

test('find makes a GET request with optional_properties', function () {
    Http::fake();

    Keap::campaign()->find(1, ['sequences']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/campaigns/1?optional_properties=sequences' &&
               $request->method() === 'GET';
    });
});

test('achieve makes a POST request', function () {
    Http::fake();

    Keap::campaign()->achieve(1, '::callName::', '::integration::');

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/campaigns/goals/::integration::/::callName::' &&
               $request->method() === 'POST';
    });
});

test('addToSequence makes a POST request', function () {
    Http::fake();

    Keap::campaign()->addToSequence(2, 3, 1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/campaigns/2/sequences/3/contacts' &&
               $request->method() === 'POST';
    });
});

test('removeFromSequence makes a DELETE request', function () {
    Http::fake();

    Keap::campaign()->removeFromSequence(2, 3, 1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/campaigns/2/sequences/3/contacts' &&
               $request->method() === 'DELETE';
    });
});
