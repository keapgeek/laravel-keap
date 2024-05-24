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

test('model makes a GET request', function () {
    Keap::note()->model();

    Http::assertSent(function ($request) {
       return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/notes/model' &&
              $request->method() === 'GET';
    });
});
