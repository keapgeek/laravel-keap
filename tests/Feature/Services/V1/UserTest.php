<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V1\User;

beforeEach(function () {
    setTokens();
    Http::fake();
});

test('facade returns a User Service', function () {
    expect(Keap::user())->toBeInstanceOf(User::class);
});

test('list makes a GET request', function () {
    Keap::user()->list();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/users/' &&
               $request->method() === 'GET';
    });
});

test('create makes a POST request', function () {
    Keap::user()->create(fake()->email(), fake()->name());

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v1/users/' &&
               $request->method() === 'POST';
    });
});

test('emailSignature makes a GET request', function () {
    $id = fake()->randomNumber(5);
    Keap::user()->emailSignature($id);

    Http::assertSent(function ($request) use ($id) {
        return $request->url() === "https://api.infusionsoft.com/crm/rest/v1/users/$id/signature" &&
               $request->method() === 'GET';
    });
});
