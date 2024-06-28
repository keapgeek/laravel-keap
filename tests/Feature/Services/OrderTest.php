<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\Order;

beforeEach(function () {
    setTokens();
});

test('facade returns a Order Service', function () {
    expect(Keap::order())->toBeInstanceOf(Order::class);
});

test('model makes a GET request', function () {
    Http::fake();

    Keap::order()->model();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/orders/model' &&
               $request->method() === 'GET';
    });
});

test('list makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['orders' => []], 200),
    ]);
    Keap::order()->list();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/orders/' &&
               $request->method() === 'GET';
    });
});

test('count makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['count' => []], 200),
    ]);
    Keap::order()->count();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/orders/' &&
               $request->method() === 'GET';
    });
});

test('create makes a POST request', function () {
    Http::fake();
    Keap::order()->create([]);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/orders/' &&
               $request->method() === 'POST';
    });
});

test('find makes a GET request', function () {
    Http::fake();
    Keap::order()->find(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/orders/1' &&
               $request->method() === 'GET';
    });
});

test('delete makes a DELETE request', function () {
    Http::fake();
    Keap::order()->delete(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/orders/1' &&
               $request->method() === 'DELETE';
    });
});

test('createItem makes a POST request', function () {
    Http::fake();
    Keap::order()->createItem(1, []);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/orders/1/items' &&
               $request->method() === 'POST';
    });
});

test('deleteItem makes a DELETE request', function () {
    Http::fake();
    Keap::order()->deleteItem(1, 2);

    Http::assertSent(function ($request) {
        dd($request->url());

        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/orders/1/items/2' &&
               $request->method() === 'DELETE';
    });
});
