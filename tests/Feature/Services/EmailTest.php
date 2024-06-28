<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Exceptions\ValidationException;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\Email;

beforeEach(function () {
    setTokens();
    Http::fake([
        '*' => Http::response(['emails' => [], 'count' => []], 200),
    ]);
});

test('facade returns a Email Service', function () {
    expect(Keap::email())->toBeInstanceOf(Email::class);
});

test('list makes a GET request', function () {
    Keap::email()->list();

    Http::assertSent(function ($request) {

        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/emails/' &&
               $request->method() === 'GET';
    });
});

test('count makes a GET request', function () {
    Keap::email()->count();

    Http::assertSent(function ($request) {

        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/emails/' &&
               $request->method() === 'GET';
    });
});

test('create makes a POST request', function () {
    Keap::email()->create(['email_name' => '::email_name::']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/emails/' &&
               $request->method() === 'POST';
    });
});

test('find makes a GET request', function () {
    Keap::email()->find(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/emails/1' &&
               $request->method() === 'GET';
    });
});

test('send makes a POST request', function () {
    Keap::email()->send(['subject' => '::subject::']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/emails/queue' &&
               $request->method() === 'POST';
    });
});

test('delete makes a DELETE request', function () {
    Keap::email()->delete(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/emails/1' &&
               $request->method() === 'DELETE';
    });
});

test('createSet makes a POST request', function () {
    Keap::email()->createSet(['::emails::'], ['::errors::']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/emails/sync' &&
               $request->method() === 'POST';
    });
});

test('unsync makes a POST request', function () {
    Keap::email()->unsync([1, 2, 3]);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/emails/unsync' &&
               $request->method() === 'POST';
    });
});
