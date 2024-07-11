<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V2\Contact;

beforeEach(function () {
    setTokens();
});

test('facade returns a Contact Service', function () {
    expect(Keap::contact('v2'))->toBeInstanceOf(Contact::class);
});


test('find makes a GET request', function () {
    Http::fake();

    Keap::contact('v2')->find(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/contacts/1' &&
               $request->method() === 'GET';
    });
});



test('create makes a POST request', function () {
    Http::fake();
    Keap::contact('v2')->create(['email' => 'test@example.com']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/contacts' &&
              $request->method() === 'POST';
    });
});

test('deletes makes a DELETE request', function () {
    Http::fake();
    Keap::contact('v2')->delete(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/contacts/1' &&
              $request->method() === 'DELETE';
    });
});

test('model makes a GET request', function () {
    Http::fake();
    Keap::contact('v2')->model();

    Http::assertSent(function ($request) {

        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/contacts/model' &&
               $request->method() === 'GET';
    });
});
