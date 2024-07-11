<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V2\Affiliate;

beforeEach(function () {
    Http::fake([
        '*' => Http::response([], 200),
    ]);
    setTokens();
});

test('facade returns a Affiliate Service', function () {
    expect(Keap::affiliate('v2'))->toBeInstanceOf(Affiliate::class);
});

test('update makes a PATCH request', function () {
    Keap::affiliate('v2')->update(1, []);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/affiliates/1' &&
               $request->method() === 'PATCH';
    });
});

test('updateProgram makes a PATCH request', function () {
    Keap::affiliate('v2')->updateProgram(1, []);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/affiliates/commissionPrograms/1' &&
               $request->method() === 'PATCH';
    });
});

test('find makes a GET request', function () {
    Keap::affiliate('v2')->find(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/affiliates/1' &&
               $request->method() === 'GET';
    });
});

test('create makes a POST request', function () {
    Keap::affiliate('v2')->create([]);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/affiliates' &&
               $request->method() === 'POST';
    });
});
