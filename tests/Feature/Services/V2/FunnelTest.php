<?php

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Services\V2\FunnelIntegration;

beforeEach(function () {
    Http::fake();
    setTokens();
});

test('facade returns a FunnelIntegration Service', function () {
    expect(Keap::funnelIntegration())->toBeInstanceOf(FunnelIntegration::class);
});

test('create makes a POST request', function () {
    Keap::funnelIntegration()->create([]);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/funnelIntegration/' &&
               $request->method() === 'POST';
    });
});

test('delete makes a DELETE request', function () {
    Keap::funnelIntegration()->delete([]);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/funnelIntegration/' &&
               $request->method() === 'DELETE';
    });
});

test('achieveGoal makes a POST request', function () {
    Keap::funnelIntegration()->achieveGoal(1, 2, '::schema_data::');

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.infusionsoft.com/crm/rest/v2/funnelIntegration/trigger' &&
               $request->method() === 'POST';
    });
});
