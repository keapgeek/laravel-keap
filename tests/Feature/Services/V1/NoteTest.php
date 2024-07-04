<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\Note;

beforeEach(function () {
    setTokens();
    Http::fake();
});

test('facade returns a Note Service', function () {
    expect(Keap::note())->toBeInstanceOf(Note::class);
});

test('create makes a POST request', function () {
    Keap::note()->create(['contact_id' => 1, 'body' => '::body::']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/notes/' &&
               $request->method() === 'POST';
    });
});

test('model makes a GET request', function () {
    Keap::note()->model();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/notes/model' &&
               $request->method() === 'GET';
    });
});

test('find makes a GET request', function () {
    Keap::note()->find(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/notes/1' &&
               $request->method() === 'GET';
    });
});

test('delete makes a DELETE request', function () {
    Keap::note()->delete(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/notes/1' &&
               $request->method() === 'DELETE';
    });
});

test('update makes a PATCH request', function () {
    Keap::note()->update(1, ['title' => '::title::']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/notes/1' &&
               $request->method() === 'PATCH';
    });
});

test('replace makes a PUT request', function () {
    Keap::note()->replace(1, ['body' => '::body::']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/notes/1' &&
               $request->method() === 'PUT';
    });
});
