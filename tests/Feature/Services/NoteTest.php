<?php

use KeapGeek\Keap\Facades\Keap;
use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Services\Note;
use KeapGeek\Keap\Exceptions\ValidationException;

beforeEach(function () {
    setTokens();
    Http::fake();
});

test('facade returns a Note Service', function () {
    expect(Keap::note())->toBeInstanceOf(Note::class);
});

test('create makes a POST request', function () {
    Keap::note()->create(111);

    Http::assertSent(function ($request) {
       return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/notes/' &&
              $request->method() === 'POST';
    });
});
test('wrong type on create returns Exception', function () {
    Keap::note()->create(111, type: '::wrong::');
})->throws(ValidationException::class);

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
