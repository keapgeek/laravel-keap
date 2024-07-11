<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V1\Affiliate;

beforeEach(function () {
    setTokens();
});

test('facade returns a Affiliate Service', function () {
    expect(Keap::affiliate())->toBeInstanceOf(Affiliate::class);
});

test('model makes a GET request', function () {
    Http::fake();
    Keap::affiliate()->model();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/affiliates/model' &&
               $request->method() === 'GET';
    });
});

test('creates makes a POST request', function () {
    Http::fake();
    Keap::affiliate()->create('::code::', 111, '::password::');

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/affiliates' &&
               $request->method() === 'POST';
    });
});

test('find makes a GET request', function () {
    Http::fake();
    Keap::affiliate()->find(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/affiliates/1' &&
               $request->method() === 'GET';
    });
});

test('list makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['affiliates' => []], 200),
    ]);
    Keap::affiliate()->list();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/affiliates' &&
               $request->method() === 'GET';
    });
});

test('count makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['count' => []], 200),
    ]);
    Keap::affiliate()->count();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/affiliates' &&
               $request->method() === 'GET';
    });
});

test('commissions makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['commissions' => []], 200),
    ]);
    Keap::affiliate()->commissions();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/affiliates/commissions?order=DATE_EARNED' &&
              $request->method() === 'GET';
    });
});

test('programs makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['programs' => []], 200),
    ]);
    Keap::affiliate()->programs();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/affiliates/programs' &&
               $request->method() === 'GET';
    });
});

test('redirects makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['redirects' => []], 200),
    ]);
    Keap::affiliate()->redirects();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/affiliates/redirectlinks' &&
               $request->method() === 'GET';
    });
});

test('summaries makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['summaries' => []], 200),
    ]);
    Keap::affiliate()->summaries();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/affiliates/summaries' &&
               $request->method() === 'GET';
    });
});

test('clawbacks makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['clawbacks' => []], 200),
    ]);
    Keap::affiliate()->clawbacks(1, []);

    Http::assertSent(function ($request) {

        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/affiliates/1/clawbacks?order=DATE_EARNED' &&
               $request->method() === 'GET';
    });
});

test('payments makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['payments' => []], 200),
    ]);
    Keap::affiliate()->payments(1, []);

    Http::assertSent(function ($request) {

        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/affiliates/1/payments' &&
               $request->method() === 'GET';
    });
});
