<?php

use KeapGeek\Keap\Facades\Keap;
use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Services\Task;
use KeapGeek\Keap\Exceptions\ValidationException;

beforeEach(function () {
    setTokens();
    Http::fake();
});

test('facade returns a Task Service', function () {
    expect(Keap::task())->toBeInstanceOf(Task::class);
});

test('model makes a GET request', function () {
    Keap::task()->model();

    Http::assertSent(function ($request) {
       return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/tasks/model' &&
              $request->method() === 'GET';
    });
});
