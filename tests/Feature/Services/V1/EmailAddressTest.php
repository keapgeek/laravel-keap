<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V1\EmailAddress;

beforeEach(function () {
    setTokens();
});

test('facade returns a EmailAddress Service', function () {
    expect(Keap::emailAddress())->toBeInstanceOf(EmailAddress::class);
});

test('replace makes a PUT request', function () {
    Http::fake();
    Keap::emailAddress()->replace('email@example.com', true);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/emailAddresses/email@example.com' &&
               $request->method() === 'PUT';
    });
});
