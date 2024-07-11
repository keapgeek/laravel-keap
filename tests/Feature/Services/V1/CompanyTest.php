<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Exceptions\ValidationException;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V1\Company;

beforeEach(function () {
    setTokens();
    Http::fake([
        '*' => Http::response(['companies' => []], 200),
    ]);
});

test('facade returns a Company Service', function () {
    expect(Keap::company())->toBeInstanceOf(Company::class);
});

test('list makes a GET request', function () {
    Keap::company()->list();

    Http::assertSent(function ($request) {

        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/companies' &&
               $request->method() === 'GET';
    });
});

test('create makes a POST request', function () {
    Keap::company()->create(['company_name' => '::company_name::']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/companies' &&
               $request->method() === 'POST';
    });
});

test('company_name is required for create', function () {
    Keap::company()->create(['key' => 'value']);

})->throws(ValidationException::class);

test('find makes a GET request', function () {
    Keap::company()->find(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/companies/1' &&
               $request->method() === 'GET';
    });
});

test('find has optional_properties', function () {
    Keap::company()->find(1, ['custom_fields', 'fax_number']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/companies/1?optional_properties=custom_fields%2Cfax_number' &&
               $request->method() === 'GET';
    });
});

test('update makes a GET request', function () {
    Keap::company()->update(1, ['company_name' => '::company_name::']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/companies/1' &&
               $request->method() === 'PATCH';
    });
});

test('company_name is required for update', function () {
    Keap::company()->create(['key' => 'value']);

})->throws(ValidationException::class);

test('model makes a GET request', function () {
    Keap::company()->model();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/companies/model' &&
               $request->method() === 'GET';
    });
});
