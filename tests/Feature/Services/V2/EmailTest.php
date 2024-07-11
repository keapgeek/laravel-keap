<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V2\Email;

beforeEach(function () {
    setTokens();
    Http::fake([
        '*' => Http::response(['emails' => []], 200),
    ]);
});

test('facade returns a Email Service', function () {
    expect(Keap::email('v2'))->toBeInstanceOf(Email::class);
});

test('create makes a POST request', function () {
    Keap::email('v2')->create(['sent_to_address' => '::sent_to_address::']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/emails' &&
               $request->method() === 'POST';
    });
});

test('find makes a GET request', function () {
    Keap::email('v2')->find(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/emails/1' &&
               $request->method() === 'GET';
    });
});

test('send makes a POST request', function () {
    Keap::email('v2')->send(['subject' => '::subject::']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/emails:send' &&
               $request->method() === 'POST';
    });
});

test('delete makes a DELETE request', function () {
    Keap::email('v2')->delete(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/emails/1' &&
               $request->method() === 'DELETE';
    });
});

test('createSet makes a POST request', function () {
    Keap::email('v2')->createSet(['::emails::'], ['::errors::']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/emails:batchAdd' &&
               $request->method() === 'POST';
    });
});

test('removeSet makes a POST request', function () {
    Keap::email('v2')->removeSet([1, 2, 3]);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/emails:batchRemove' &&
               $request->method() === 'POST';
    });
});
