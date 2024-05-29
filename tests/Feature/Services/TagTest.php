<?php

use KeapGeek\Keap\Facades\Keap;
use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Services\Tag;

beforeEach(function () {
    setTokens();
    Http::fake();
});

test('facade returns a Tag Service', function () {
    expect(Keap::tag())->toBeInstanceOf(Tag::class);
});

test('createCategory makes a POST request', function () {
    Keap::tag()->createCategory('::name::', '::description::');

    Http::assertSent(function ($request) {
       return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/tags/categories' &&
              $request->method() === 'POST';
    });
});
