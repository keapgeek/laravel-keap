<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V2\Campaign;

beforeEach(function () {
    Http::fake([
        '*' => Http::response(['campaigns' => []], 200),
    ]);
    setTokens();
});

test('facade returns a Campaign Service', function () {
    expect(Keap::campaign('v2'))->toBeInstanceOf(Campaign::class);
});

test('list makes a GET request', function () {
    Keap::campaign('v2')->list();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/campaigns/' &&
               $request->method() === 'GET';
    });
});

test('addContacts makes a POST request', function () {
    Keap::campaign('v2')->addContacts(1, 2, [3]);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/campaigns/1/sequences/2:addContacts' &&
               $request->method() === 'POST';
    });
});

test('addContact makes a POST request', function () {
    Keap::campaign('v2')->addContact(1, 2, 3);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/campaigns/1/sequences/2:addContacts' &&
               $request->method() === 'POST';
    });
});

test('removeContacts makes a POST request', function () {
    Keap::campaign('v2')->removeContacts(1, 2, [3]);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/campaigns/1/sequences/2:removeContacts' &&
               $request->method() === 'POST';
    });
});

test('removeContact makes a POST request', function () {
    Keap::campaign('v2')->removeContact(1, 2, 3);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/campaigns/1/sequences/2:removeContacts' &&
               $request->method() === 'POST';
    });
});


test('find makes a GET request', function () {
    Keap::campaign('v2')->find(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/campaigns/1' &&
               $request->method() === 'GET';
    });
});
