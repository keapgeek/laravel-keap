<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V2\Subscription;

beforeEach(function () {
    Http::fake();
    setTokens();
});

test('facade returns a Subscription Service', function () {
    expect(Keap::subscription())->toBeInstanceOf(Subscription::class);
});

test('create makes a GET request', function () {
    Keap::subscription()->create([]);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/subscriptions' &&
               $request->method() === 'POST';
    });
});
