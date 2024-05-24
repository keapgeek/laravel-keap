<?php

use KeapGeek\Keap\Facades\Keap;
use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Services\Order;
use KeapGeek\Keap\Exceptions\ValidationException;

beforeEach(function () {
    setTokens();
    Http::fake();
});

test('facade returns a Order Service', function () {
    expect(Keap::order())->toBeInstanceOf(Order::class);
});

test('model makes a GET request', function () {
    Keap::order()->model();

    Http::assertSent(function ($request) {
       return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/orders/model' &&
              $request->method() === 'GET';
    });
});
