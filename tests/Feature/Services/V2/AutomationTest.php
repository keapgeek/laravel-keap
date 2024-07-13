<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V2\Automation;

beforeEach(function () {
    Http::fake([
        '*' => Http::response(['automations' => [], 'automation_count' => []], 200),
    ]);
    setTokens();
});

test('facade returns a Automation Service', function () {
    expect(Keap::automation())->toBeInstanceOf(Automation::class);
});

test('list makes a GET request', function () {
    Keap::automation()->list();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/automations' &&
               $request->method() === 'GET';
    });
});

test('count makes a GET request', function () {
    Keap::automation()->count();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/automations' &&
               $request->method() === 'GET';
    });
});

test('updateCategory makes a PUT request', function () {
    Keap::automation()->updateCategory(1, 2);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/automations/category' &&
               $request->method() === 'PUT';
    });
});

test('delete makes a DELETE request', function () {
    Keap::automation()->delete(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/automations?ids=1' &&
               $request->method() === 'DELETE';
    });
});

test('find makes a GET request', function () {
    Keap::automation()->find(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/automations/1' &&
               $request->method() === 'GET';
    });
});

test('addContact makes a POST request', function () {
    Keap::automation()->addContact(1, 2, 3);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/automations/1/sequences/2:addContacts' &&
               $request->method() === 'POST';
    });
});

test('addContacts makes a POST request', function () {
    Keap::automation()->addContacts(1, 2, [1, 2, 3]);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/automations/1/sequences/2:addContacts' &&
               $request->method() === 'POST';
    });
});
