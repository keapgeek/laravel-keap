<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Exceptions\KeapException;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\Form;

beforeEach(function () {
    setTokens();
    Http::fake();
});


test('if config is not set throws Exception5', function () {
    Config::set('keap.app_name', null);
    Keap::submitForm('::xid::', '1.2.3', []);
})->throws(KeapException::class);

test('if config is set it sends Http call', function () {
    Config::set('keap.app_name', 'aaa111');
    Keap::submitForm('::xid::', '1.2.3', []);
    Http::assertSent(function ($request) {
        return $request->url() === 'https://aaa111.infusionsoft.com/app/form/process/::xid::' &&
               $request->method() === 'POST';
    });
});
