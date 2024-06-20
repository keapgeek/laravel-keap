<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\Opportunity;

beforeEach(function () {
    setTokens();
});

test('facade returns a Opportunity Service', function () {
    expect(Keap::opportunity())->toBeInstanceOf(Opportunity::class);
});

test('model makes a GET request', function () {
    Http::fake();
    Keap::opportunity()->model();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/opportunities/model' &&
               $request->method() === 'GET';
    });
});

test('list makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['opportunities' => []], 200),
    ]);
    Keap::opportunity()->list();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/opportunities/' &&
               $request->method() === 'GET';
    });
});

test('count makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['count' => []], 200),
    ]);
    Keap::opportunity()->count();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/opportunities/' &&
               $request->method() === 'GET';
    });
});

test('creates makes a POST request', function () {
    Http::fake();
    Keap::opportunity()->create([
        'title' => '::title::',
    ]);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/opportunities/' &&
              $request->method() === 'POST';
    });
});

test('find makes a GET request', function () {
    Http::fake();
    Keap::opportunity()->find(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/opportunities/1' &&
              $request->method() === 'GET';
    });
});

test('update makes a POST request', function () {
    Http::fake();
    Keap::opportunity()->update(1, ['title' => '::title::']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/opportunities/1' &&
               $request->method() === 'PATCH';
    });
});

test('replace makes a PUT request', function () {
    Http::fake();
    Keap::opportunity()->replace(['data' => '::data::']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/opportunities/' &&
               $request->method() === 'PUT';
    });
});

test('pipeline makes a GET request', function () {
    Http::fake();
    Keap::opportunity()->pipeline();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/opportunity/stage_pipeline' &&
               $request->method() === 'GET';
    });
});
