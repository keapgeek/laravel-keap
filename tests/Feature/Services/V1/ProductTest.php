<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V1\Product;

beforeEach(function () {
    setTokens();
});

test('facade returns a Product Service', function () {
    expect(Keap::product())->toBeInstanceOf(Product::class);
});

test('list makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['products' => []], 200),
    ]);
    Keap::product()->list();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/products/' &&
               $request->method() === 'GET';
    });
});

test('count makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['count' => []], 200),
    ]);
    Keap::product()->count();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/products/' &&
               $request->method() === 'GET';
    });
});

test('creates makes a POST request', function () {
    Http::fake();
    Keap::product()->create([
        'title' => '::title::',
    ]);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/products/' &&
              $request->method() === 'POST';
    });
});

test('find makes a GET request', function () {
    Http::fake();
    Keap::product()->find(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/products/1' &&
              $request->method() === 'GET';
    });
});

test('update makes a POST request', function () {
    Http::fake();
    Keap::product()->update(1, ['title' => '::title::']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/products/1' &&
               $request->method() === 'PATCH';
    });
});

test('createSubscription makes a POST request', function () {
    Http::fake();
    Keap::product()->createSubscription(1, ['title' => '::title::']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/products/1/subscriptions' &&
               $request->method() === 'POST';
    });
});

test('findSubscription makes a GET request', function () {
    Http::fake();
    Keap::product()->findSubscription(1, 2);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/products/1/subscriptions/2' &&
               $request->method() === 'GET';
    });
});

test('deleteSubscription makes a DELETE request', function () {
    Http::fake();
    Keap::product()->deleteSubscription(1, 2);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/products/1/subscriptions/2' &&
               $request->method() === 'DELETE';
    });
});

test('uploadImage makes a POST request', function () {
    Http::fake();
    Keap::product()->uploadImage(1, ['image' => '::image::']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/products/1/image' &&
               $request->method() === 'POST';
    });
});

test('deleteImage makes a DELETE request', function () {
    Http::fake();
    Keap::product()->deleteImage(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/products/1/image' &&
               $request->method() === 'DELETE';
    });
});
