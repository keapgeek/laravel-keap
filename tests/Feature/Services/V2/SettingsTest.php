<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V2\Settings;

beforeEach(function () {
    setTokens();
    Http::fake([
        '*' => Http::response(['enabled' => 'true', 'option_types' => []], 200),
    ]);
});

test('facade returns a Settings Service', function () {
    expect(Keap::settings('v2'))->toBeInstanceOf(Settings::class);
});

test('status makes a GET request', function () {
     Keap::settings('v2')->status();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/settings/applications:isEnabled' &&
               $request->method() === 'GET';
    });
});

test('contactOptionTypes makes a GET request', function () {
    Keap::settings('v2')->contactOptionTypes();

   Http::assertSent(function ($request) {
       return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/settings/contactOptionTypes' &&
              $request->method() === 'GET';
   });
});


test('config makes a GET request', function () {
    Keap::settings('v2')->config();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/settings/applications:getConfiguration' &&
               $request->method() === 'GET';
    });
});
