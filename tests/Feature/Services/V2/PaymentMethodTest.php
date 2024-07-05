<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V2\PaymentMethod;

beforeEach(function () {
    Http::fake();
    setTokens();
});

test('facade returns a PaymentMethod Service', function () {
    expect(Keap::paymentMethod())->toBeInstanceOf(PaymentMethod::class);
});

test('createKey makes a POST request', function () {
    Keap::paymentMethod()->createKey(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/paymentMethodConfigs/' &&
               $request->method() === 'POST';
    });
});
