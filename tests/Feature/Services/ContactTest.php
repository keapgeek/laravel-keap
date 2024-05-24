<?php

use KeapGeek\Keap\Facades\Keap;
use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Exceptions\ValidationException;
use KeapGeek\Keap\Services\Contact;

beforeEach(function () {
    setTokens();
    Http::fake();
});

test('facade returns a Company Service', function () {
    expect(Keap::contact())->toBeInstanceOf(Contact::class);
});

// test('list makes a GET request', function () {
//     Keap::company()->list();

//     Http::assertSent(function ($request) {
//        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/companies/' &&
//               $request->method() === 'GET';
//     });
// });

// test('creates makes a POST request', function () {
//     Keap::company()->create(['company_name' => '::company_name::']);

//     Http::assertSent(function ($request) {
//        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/companies/' &&
//               $request->method() === 'POST';
//     });
// });


// test('company_name is required for create', function () {

//     Keap::company()->create(['key' => 'value']);

// })->throws(ValidationException::class);

test('model makes a GET request', function () {
    Keap::contact()->model();

    Http::assertSent(function ($request) {
       return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/contacts/model' &&
              $request->method() === 'GET';
    });
});