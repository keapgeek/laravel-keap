<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V2\Sales;

beforeEach(function () {
    setTokens();
    Http::fake();
});

test('facade returns a Sales Service', function () {
    expect(Keap::sales())->toBeInstanceOf(Sales::class);
});

test('setDefault makes a POST request', function () {
    Keap::sales()->setDefault(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/sales/merchants/1:setDefault' &&
               $request->method() === 'POST';
    });
});
