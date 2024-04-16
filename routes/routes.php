<?php

use Illuminate\Support\Facades\Route;
use Azzarip\Keap\Http\Controllers\KeapController;

Route::controller(KeapController::class)->group(function () {
    Route::get('/keap/auth', 'auth');
    Route::get('/keap/callback', 'callback');
});
