<?php

use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\Account;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    setTokens();
});

test('facade returns a Account Service', function () {
    expect( Keap::account())->toBeInstanceOf(Account::class);
});

test('retrieve makes a GET request', function () {
    Http::fake();

    Keap::account()->info();

    Http::assertSent(function ($request) {
       return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/account/profile/' &&
              $request->method() === 'GET';
    });
});

test('updates makes a PUT request', function () {
    Http::fake();

    Keap::account()->update(['key' => 'value']);

    Http::assertSent(function ($request) {
       return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/account/profile/' &&
              $request->method() === 'PUT';
    });
});
