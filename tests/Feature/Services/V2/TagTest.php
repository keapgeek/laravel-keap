<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V2\Tag;

beforeEach(function () {
    Http::fake([
        '*' => Http::response([
            'tags' => '',
            'tag_categories' => '',
            'tagged_companies' => '',
            'contacts' => '',
        ], 200),
    ]);
    setTokens();
});

test('facade returns a Tag Service', function () {
    expect(Keap::tag('v2'))->toBeInstanceOf(Tag::class);
});

test('list makes a GET request', function () {
    Keap::tag('v2')->list();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/tags' &&
               $request->method() === 'GET';
    });
});

test('create makes a POST request', function () {
    Keap::tag('v2')->create([]);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/tags' &&
               $request->method() === 'POST';
    });
});

test('update makes a PATCH request', function () {
    Keap::tag('v2')->update(1, []);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/tags/1' &&
               $request->method() === 'PATCH';
    });
});

test('delete makes a DELETE request', function () {
    Keap::tag('v2')->delete(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/tags/1' &&
               $request->method() === 'DELETE';
    });
});

test('find makes a GET request', function () {
    Keap::tag('v2')->find(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/tags/1' &&
               $request->method() === 'GET';
    });
});

test('listCategories makes a GET request', function () {
    Keap::tag('v2')->listCategories();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/tags/categories' &&
               $request->method() === 'GET';
    });
});

test('findCategory makes a GET request', function () {
    Keap::tag('v2')->findCategory(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/tags/categories/1' &&
               $request->method() === 'GET';
    });
});

test('deleteCategory makes a DELETE request', function () {
    Keap::tag('v2')->deleteCategory(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/tags/categories/1' &&
               $request->method() === 'DELETE';
    });
});

test('createCategory makes a POST request', function () {
    Keap::tag('v2')->createCategory([]);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/tags/categories' &&
               $request->method() === 'POST';
    });
});

test('updateCategory makes a PATCH request', function () {
    Keap::tag('v2')->updateCategory(1, []);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/tags/categories/1' &&
               $request->method() === 'PATCH';
    });
});

test('listCompanies makes a GET request', function () {
    Keap::tag('v2')->listCompanies(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/tags/1/companies' &&
               $request->method() === 'GET';
    });
});

test('listContacts makes a GET request', function () {
    Keap::tag('v2')->listContacts(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/tags/1/contacts' &&
               $request->method() === 'GET';
    });
});

test('apply makes a POST request', function () {
    Keap::tag('v2')->apply(1, [1, 2, 3]);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/tags/1/contacts:applyTags' &&
               $request->method() === 'POST';
    });
});

test('remove makes a POST request', function () {
    Keap::tag('v2')->remove(1, [1, 2, 3]);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/tags/1/contacts:removeTags' &&
        $request->method() === 'POST';
    });
});
