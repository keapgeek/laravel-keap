<?php

use Illuminate\Support\Facades\Route;
use KeapGeek\Keap\Http\Controllers\KeapController;

Route::group([
    'middleware' => config('keap.middleware', []),
    'controller' => KeapController::class,
], function () {
    Route::get('/keap/auth', 'auth');
    Route::get('/keap/callback', 'callback');
});
