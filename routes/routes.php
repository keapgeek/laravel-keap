<?php

use Illuminate\Support\Facades\Route;
use KeapGeek\Keap\Http\Controllers\KeapController;

Route::group([
    'middleware' => config('keap.middleware', []),
], function () {
    Route::get('/keap/auth', [KeapController::class, 'auth']);
    Route::get('/keap/callback', [KeapController::class, 'callback']);
});
