<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V2\BusinessProfile;

beforeEach(function () {
    Http::fake();
    setTokens();
});

test('facade returns a BusinessProfile Service', function () {
    expect(Keap::businessProfile())->toBeInstanceOf(BusinessProfile::class);
});

test('info makes a GET request', function () {
    Keap::businessProfile()->info();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/businessProfile' &&
               $request->method() === 'GET';
    });
});

test('updates makes a PATCH request', function () {
    Keap::businessProfile()->update(['key' => 'value']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/businessProfile' &&
               $request->method() === 'PATCH';
    });
});
