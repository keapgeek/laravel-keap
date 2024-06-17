<?php

use Illuminate\Support\Facades\Cache;
use KeapGeek\Keap\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

function setTokens()
{
    Cache::put('keap.access_token', 'access_token', 100);
    Cache::put('keap.refresh_token', 'refresh_token', 100);
}
