<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\Contact;

beforeEach(function () {
    setTokens();
});

test('facade returns a Contact Service', function () {
    expect(Keap::contact())->toBeInstanceOf(Contact::class);
});

test('list makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['contacts' => []], 200),
    ]);

    Keap::contact()->list();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/contacts/' &&
               $request->method() === 'GET';
    });
});

test('count makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['count' => []], 200),
    ]);

    Keap::contact()->count();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/contacts/' &&
               $request->method() === 'GET';
    });
});

test('find makes a GET request', function () {
    Http::fake();

    Keap::contact()->find(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/contacts/1' &&
               $request->method() === 'GET';
    });
});

test('emails makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['emails' => []], 200),
    ]);
    Keap::contact()->emails(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/contacts/1/emails' &&
              $request->method() === 'GET';
    });
});

test('create makes a POST request', function () {
    Http::fake();
    Keap::contact()->create(['email' => 'test@example.com']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/contacts/' &&
              $request->method() === 'POST';
    });
});

test('createOrUpdate makes a PUT request', function () {
    Http::fake();
    Keap::contact()->createOrUpdate(['email' => 'test@example.com']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/contacts/' &&
              $request->method() === 'PUT';
    });
});

test('update makes a PATCH request', function () {
    Http::fake();
    Keap::contact()->update(1, ['email' => 'test@example.com']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/contacts/1' &&
              $request->method() === 'PATCH';
    });
});

test('createEmail makes a POST request', function () {
    Http::fake();
    Keap::contact()->createEmail(1, ['sent_to_Address' => 'test@example.com']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/contacts/1/emails' &&
              $request->method() === 'POST';
    });
});

test('listCreditCards makes a GET request', function () {
    Http::fake();
    Keap::contact()->listCreditCards(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/contacts/1/creditCards' &&
              $request->method() === 'GET';
    });
});

test('createCreditCard makes a POST request', function () {
    Http::fake();
    Keap::contact()->createCreditCard(1, []);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/contacts/1/creditCards' &&
              $request->method() === 'POST';
    });
});

test('deletes makes a DELETE request', function () {
    Http::fake();
    Keap::contact()->delete(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/contacts/1' &&
              $request->method() === 'DELETE';
    });
});

test('model makes a GET request', function () {
    Http::fake();
    Keap::contact()->model();

    Http::assertSent(function ($request) {

        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/contacts/model' &&
               $request->method() === 'GET';
    });
});

test('tags makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['tags' => []], 200),
    ]);
    Keap::contact()->tags(1);

    Http::assertSent(function ($request) {

        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/contacts/1/tags' &&
               $request->method() === 'GET';
    });
});

test('tag makes a POST request', function () {
    Http::fake();
    Keap::contact()->tag(1, [2]);

    Http::assertSent(function ($request) {

        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/contacts/1/tags' &&
               $request->method() === 'POST';
    });
});

test('removeTag makes a DELETE request', function () {
    Http::fake();
    Keap::contact()->removeTag(1, 2);

    Http::assertSent(function ($request) {

        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/contacts/1/tags/2' &&
               $request->method() === 'DELETE';
    });
});

test('removeTags makes a DELETE request', function () {
    Http::fake();
    Keap::contact()->removeTags(1, [1, 2, 3]);

    Http::assertSent(function ($request) {

        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/contacts/1/tags?ids=1%2C2%2C3' &&
               $request->method() === 'DELETE';
    });
});

test('insertUtm makes a GET request', function () {
    Http::fake();
    Keap::contact()->insertUtm(1, 2);

    Http::assertSent(function ($request) {

        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/contacts/1/utm' &&
               $request->method() === 'POST';
    });
});
