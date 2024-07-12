<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V2\Contact;

beforeEach(function () {
    setTokens();
    Http::fake([
        '*' => Http::response(['records' => [], 'contact_link_types' => [], 'links' => []], 200),
    ]);
});

test('facade returns a Contact Service', function () {
    expect(Keap::contact('v2'))->toBeInstanceOf(Contact::class);
});

test('find makes a GET request', function () {

    Keap::contact('v2')->find(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/contacts/1' &&
               $request->method() === 'GET';
    });
});

test('create makes a POST request', function () {
    Keap::contact('v2')->create(['email' => 'test@example.com']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/contacts' &&
              $request->method() === 'POST';
    });
});

test('deletes makes a DELETE request', function () {
    Keap::contact('v2')->delete(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/contacts/1' &&
              $request->method() === 'DELETE';
    });
});

test('model makes a GET request', function () {
    Keap::contact('v2')->model();

    Http::assertSent(function ($request) {

        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/contacts/model' &&
               $request->method() === 'GET';
    });
});

test('update makes a PATCH request', function () {
    Keap::contact('v2')->update(1, ['key' => 'value']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/contacts/1' &&
               $request->method() === 'PATCH';
    });
});

test('paymentMethods makes a PATCH request', function () {
    Keap::contact('v2')->paymentMethods(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/contacts/1/paymentMethods' &&
               $request->method() === 'GET';
    });
});

test('list makes a GET request', function () {
    Keap::contact('v2')->list();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/contacts' &&
               $request->method() === 'GET';
    });
});

test('listLinkTypes makes a GET request', function () {
    Keap::contact('v2')->listLinkTypes();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/contacts/links/types' &&
               $request->method() === 'GET';
    });
});

test('createLinkType makes a POST request', function () {
    Keap::contact('v2')->createLinkType('::name::');

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/contacts/links/types' &&
               $request->method() === 'POST';
    });
});

test('listLinkedContacts makes a GET request', function () {
    Keap::contact('v2')->listLinkedContacts(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/contacts/1/links' &&
               $request->method() === 'GET';
    });
});

test('link makes a POST request', function () {
    Keap::contact('v2')->link(1, 2, 3);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/contacts:link' &&
               $request->method() === 'POST';
    });
});

test('unlink makes a POST request', function () {
    Keap::contact('v2')->unlink(1, 2, 3);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/contacts:unlink' &&
               $request->method() === 'POST';
    });
});
