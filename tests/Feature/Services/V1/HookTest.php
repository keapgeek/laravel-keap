<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V1\Hook;

beforeEach(function () {
    setTokens();
    Http::fake([]);
});

test('facade returns a Hook Service', function () {
    expect(Keap::hook())->toBeInstanceOf(Hook::class);
});

test('list makes a GET request', function () {
    Keap::hook()->list();

    Http::assertSent(function ($request) {

        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/hooks' &&
               $request->method() === 'GET';
    });
});

test('types makes a GET request', function () {
    Keap::hook()->types();

    Http::assertSent(function ($request) {

        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/hooks/event_keys' &&
               $request->method() === 'GET';
    });
});

test('find makes a GET request', function () {
    Keap::hook()->find(1);

    Http::assertSent(function ($request) {

        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/hooks/1' &&
               $request->method() === 'GET';
    });
});

test('delete makes a DELETE request', function () {
    Keap::hook()->delete(1);

    Http::assertSent(function ($request) {

        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/hooks/1' &&
               $request->method() === 'DELETE';
    });
});

test('create makes a POST request', function () {
    Keap::hook()->create('::event_key::', '::url::');

    Http::assertSent(function ($request) {

        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/hooks' &&
               $request->method() === 'POST';
    });
});

test('update makes a PUT request', function () {
    Keap::hook()->update('::key::', '::event_key::', '::url::');

    Http::assertSent(function ($request) {

        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/hooks/::key::' &&
               $request->method() === 'PUT';
    });
});

test('verify makes a POST request', function () {
    Keap::hook()->verify('::key::');

    Http::assertSent(function ($request) {

        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/hooks/::key::/verify' &&
               $request->method() === 'POST';
    });
});
