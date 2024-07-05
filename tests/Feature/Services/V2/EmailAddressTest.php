<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V2\EmailAddress;

beforeEach(function () {
    setTokens();
    Http::fake();
});

test('facade returns a EmailAddress Service', function () {
    expect(Keap::emailAddress('v2'))->toBeInstanceOf(EmailAddress::class);
});

test('updateStatus makes a PUT request', function () {
    Keap::emailAddress('v2')->updateStatus('email@example.com', true);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/emailAddresses/email@example.com' &&
               $request->method() === 'PUT';
    });
});

test('find makes a PUT request', function () {
    Keap::emailAddress('v2')->find('email@example.com');

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/emailAddresses/email@example.com' &&
               $request->method() === 'GET';
    });
});
