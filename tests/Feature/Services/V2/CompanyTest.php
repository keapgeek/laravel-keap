<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V2\Company;

beforeEach(function () {
    Http::fake([
        '*' => Http::response(['companies' => [], 'automation_count' => []], 200),
    ]);
    setTokens();
});

test('facade returns a Company Service', function () {
    expect(Keap::company('v2'))->toBeInstanceOf(Company::class);
});

test('list makes a GET request', function () {
    Keap::company('v2')->list();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/companies' &&
               $request->method() === 'GET';
    });
});

test('create makes a POST request', function () {
    Keap::company('v2')->create([]);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/companies' &&
               $request->method() === 'POST';
    });
});

test('update makes a PATCH request', function () {
    Keap::company('v2')->update(1, ['key' => 'value']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/companies/1' &&
               $request->method() === 'PATCH';
    });
});

test('delete makes a DELETE request', function () {
    Keap::company('v2')->delete(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/companies/1' &&
               $request->method() === 'DELETE';
    });
});

test('find makes a GET request', function () {
    Keap::company('v2')->find(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/companies/1' &&
               $request->method() === 'GET';
    });
});
