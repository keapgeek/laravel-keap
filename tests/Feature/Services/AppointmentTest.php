<?php

use KeapGeek\Keap\Facades\Keap;
use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Services\Appointment;
use KeapGeek\Keap\Exceptions\ValidationException;

beforeEach(function () {
    setTokens();
    Http::fake();
});

test('facade returns a Affiliate Service', function () {
    expect(Keap::appointment())->toBeInstanceOf(Appointment::class);
});

test('model makes a GET request', function () {
    Keap::appointment()->model();

    Http::assertSent(function ($request) {
       return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/appointments/model' &&
              $request->method() === 'GET';
    });
});
