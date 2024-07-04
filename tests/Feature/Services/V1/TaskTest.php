<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V1\Task;

beforeEach(function () {
    setTokens();
});

test('facade returns a Task Service', function () {
    expect(Keap::task())->toBeInstanceOf(Task::class);
});

test('model makes a GET request', function () {
    Http::fake();
    Keap::task()->model();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/tasks/model' &&
               $request->method() === 'GET';
    });
});

test('list makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['tasks' => []], 200),
    ]);
    Keap::task()->list();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/tasks/' &&
               $request->method() === 'GET';
    });
});

test('count makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['count' => []], 200),
    ]);
    Keap::task()->count();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/tasks/' &&
               $request->method() === 'GET';
    });
});

test('creates makes a POST request', function () {
    Http::fake();
    Keap::task()->create([
        'title' => '::title::',
    ]);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/tasks/' &&
              $request->method() === 'POST';
    });
});

test('find makes a GET request', function () {
    Http::fake();
    Keap::task()->find(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/tasks/1' &&
              $request->method() === 'GET';
    });
});

test('deletes makes a DELETE request', function () {
    Http::fake();
    Keap::task()->delete(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/tasks/1' &&
              $request->method() === 'DELETE';
    });
});

test('update makes a PATCH request', function () {
    Http::fake();
    Keap::task()->update(1, ['title' => '::title::']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/tasks/1' &&
               $request->method() === 'PATCH';
    });
});

test('replace makes a PUT request', function () {
    Http::fake();
    Keap::task()->replace(1, ['body' => '::body::']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/tasks/1' &&
               $request->method() === 'PUT';
    });
});

test('search makes a GET request', function () {
    Http::fake([
        '*' => Http::response(['tasks' => []], 200),
    ]);
    Keap::task()->search();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/tasks/search' &&
               $request->method() === 'GET';
    });
});
