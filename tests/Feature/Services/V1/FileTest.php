<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V1\File;

beforeEach(function () {
    setTokens();
});

test('facade returns a File Service', function () {
    expect(Keap::file())->toBeInstanceOf(File::class);
});

test('list makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['files' => []], 200),
    ]);

    Keap::file()->list();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/files/' &&
               $request->method() === 'GET';
    });
});

test('count makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['count' => []], 200),
    ]);

    Keap::file()->count();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/files/' &&
               $request->method() === 'GET';
    });
});

test('delete makes a GET request', function () {
    Http::fake();

    Keap::file()->delete(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/files/1' &&
               $request->method() === 'DELETE';
    });
});

test('find makes a GET request', function () {
    Http::fake();

    Keap::file()->find(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/files/1' &&
               $request->method() === 'GET';
    });
});

test('upload makes a POST request', function () {
    Http::fake();

    Keap::file()->upload('::name::', '::data::');

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/files/' &&
               $request->method() === 'POST';
    });
});

test('replace makes a PUT request', function () {
    Http::fake();

    Keap::file()->replace(1, '::name::', '::data::');

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/files/1' &&
               $request->method() === 'PUT';
    });
});
