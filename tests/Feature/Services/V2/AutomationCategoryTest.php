<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V2\AutomationCategory;

beforeEach(function () {
    Http::fake([
        '*' => Http::response(['automation_categories' => []], 200),
    ]);
    setTokens();
});

test('facade returns a AutomationCategory Service', function () {
    expect(Keap::automationCategory())->toBeInstanceOf(AutomationCategory::class);
});

test('list makes a GET request', function () {
    Keap::automationCategory()->list();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/automationCategory' &&
               $request->method() === 'GET';
    });
});

test('create makes a POST request', function () {
    Keap::automationCategory()->create('::name::');

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/automationCategory' &&
               $request->method() === 'POST';
    });
});

test('update makes a PUT request', function () {
    Keap::automationCategory()->update(1, '::name::');

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/automationCategory' &&
               $request->method() === 'PUT';
    });
});

test('delete makes a DELETE request', function () {
    Keap::automationCategory()->delete(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/automationCategory' &&
               $request->method() === 'DELETE';
    });
});
