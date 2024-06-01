<?php

use KeapGeek\Keap\Facades\Keap;
use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Services\Affiliate;
use KeapGeek\Keap\Exceptions\ValidationException;

beforeEach(function () {
    setTokens();
    Http::fake();
});

test('facade returns a Affiliate Service', function () {
    expect(Keap::affiliate())->toBeInstanceOf(Affiliate::class);
});

test('model makes a GET request', function () {
    Keap::affiliate()->model();

    Http::assertSent(function ($request) {
       return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/affiliates/model' &&
              $request->method() === 'GET';
    });
});

test('creates makes a POST request', function () {
    Keap::affiliate()->create('::code::', 111, '::password::');

    Http::assertSent(function ($request) {
       return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/affiliates/' &&
              $request->method() === 'POST';
    });
});
