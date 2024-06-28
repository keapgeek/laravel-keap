<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\Form;

beforeEach(function () {
    setTokens();
    Http::fake();
});

test('facade returns a Form Service', function () {
    expect(Keap::submitForm('::xid::', []))->toBeInstanceOf(Form::class);
});

test('if config is not set no Http call', function () {
    Config::set('keap.app_name', null);
    Keap::submitForm('::xid::', []);
    Http::assertNothingSent();
});

test('if config is set it sends Http call', function () {
    Config::set('keap.app_name', 'aaa111');
    Keap::submitForm('::xid::', []);
    Http::assertSent(function ($request) {
        return $request->url() === 'https://aaa111.infusionsoft.com/app/form/process/::xid::' &&
               $request->method() === 'POST';
    });
});
