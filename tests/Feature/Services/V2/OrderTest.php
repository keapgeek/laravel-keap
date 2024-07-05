<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V2\Order;

beforeEach(function () {
    Http::fake();
    setTokens();
});

test('facade returns a Order Service', function () {
    expect(Keap::order('v2'))->toBeInstanceOf(Order::class);
});

test('createPayment makes a POST request', function () {
    Keap::order('v2')->createPayment(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/orders/1/payments' &&
               $request->method() === 'POST';
    });
});
