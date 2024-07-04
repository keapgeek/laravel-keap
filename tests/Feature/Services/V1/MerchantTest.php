<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V1\Merchant;

beforeEach(function () {
    setTokens();
});

test('facade returns a Merchant Service', function () {
    expect(Keap::merchant())->toBeInstanceOf(Merchant::class);
});

test('list makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['merchant_accounts' => []], 200),
    ]);

    Keap::merchant()->list();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/merchants/' &&
               $request->method() === 'GET';
    });
});

test('default makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['default_merchant_account' => []], 200),
    ]);

    Keap::merchant()->default();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/merchants/' &&
               $request->method() === 'GET';
    });
});
