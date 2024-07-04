<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\Appointment;

beforeEach(function () {
    setTokens();
});

test('facade returns a Affiliate Service', function () {
    expect(Keap::appointment())->toBeInstanceOf(Appointment::class);
});

test('model makes a GET request', function () {
    Http::fake();
    Keap::appointment()->model();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/appointments/model' &&
               $request->method() === 'GET';
    });
});

test('list makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['appointments' => []], 200),
    ]);
    Keap::appointment()->list();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/appointments/' &&
               $request->method() === 'GET';
    });
});

test('count makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['count' => []], 200),
    ]);
    Keap::appointment()->count();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/appointments/' &&
               $request->method() === 'GET';
    });
});

test('creates makes a POST request', function () {
    Http::fake();
    Keap::appointment()->create([
        'title' => '::title::',
    ]);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/appointments/' &&
              $request->method() === 'POST';
    });
});

test('find makes a GET request', function () {
    Http::fake();
    Keap::appointment()->find(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/appointments/1' &&
              $request->method() === 'GET';
    });
});

test('deletes makes a DELETE request', function () {
    Http::fake();
    Keap::appointment()->delete(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/appointments/1' &&
              $request->method() === 'DELETE';
    });
});

test('update makes a PATCH request', function () {
    Http::fake();
    Keap::appointment()->update(1, ['title' => '::title::']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/appointments/1' &&
               $request->method() === 'PATCH';
    });
});

test('replace makes a PUT request', function () {
    Http::fake();
    Keap::appointment()->replace(1, ['body' => '::body::']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/appointments/1' &&
               $request->method() === 'PUT';
    });
});
