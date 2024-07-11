<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V2\Note;

beforeEach(function () {
    Http::fake([
        '*' => Http::response(['notes' => []], 200),
    ]);
    setTokens();
});

test('facade returns a Note Service', function () {
    expect(Keap::note('v2'))->toBeInstanceOf(Note::class);
});

test('list makes a GET request', function () {
    Keap::note('v2')->list(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/contacts/1/notes' &&
               $request->method() === 'GET';
    });
});

test('create makes a POST request', function () {
    Keap::note('v2')->create(1, []);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/contacts/1/notes' &&
               $request->method() === 'POST';
    });
});

test('update makes a PATCH request', function () {
    Keap::note('v2')->update(1, 2, []);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/contacts/2/notes/1' &&
               $request->method() === 'PATCH';
    });
});

test('delete makes a DELETE request', function () {
    Keap::note('v2')->delete(1, 2);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/contacts/2/notes/1' &&
               $request->method() === 'DELETE';
    });
});

test('find makes a GET request', function () {
    Keap::note('v2')->find(1, 2);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/contacts/2/notes/1' &&
               $request->method() === 'GET';
    });
});
