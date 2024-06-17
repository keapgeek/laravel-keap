<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
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

test('create makes a POST request', function () {
    Keap::tag()->create('::name::', '::description::');

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/tags/' &&
               $request->method() === 'POST';
    });
});

test('list makes a GET request', function () {
    Keap::tag()->list();

    Http::assertSent(function ($request) {

        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/tags/' &&
               $request->method() === 'GET';
    });
});

test('find makes a GET request', function () {
    Keap::tag()->find(1);

    Http::assertSent(function ($request) {

        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/tags/1' &&
               $request->method() === 'GET';
    });
});

test('removeFromContacts makes DELETE request', function () {
    Keap::tag()->removeFromContacts(1, [1, 2, 3]);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/tags/1/contacts?ids=1,2,3' &&
               $request->method() === 'DELETE';
    });
});

test('removeFromContact makes DELETE request', function () {
    Keap::tag()->removeFromContact(1, 2);

    Http::assertSent(function ($request) {

        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/tags/1/contacts/2' &&
               $request->method() === 'DELETE';
    });
});

test('applyToContacts makes POST request', function () {
    Keap::tag()->applyToContacts(1, [1, 2, 3]);

    Http::assertSent(function ($request) {

        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/tags/1/contacts' &&
               $request->method() === 'POST';
    });
});
