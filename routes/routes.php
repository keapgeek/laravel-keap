<?php

use Azzarip\Keap\Http\Controllers\KeapController;
use Illuminate\Support\Facades\Route;

Route::controller(KeapController::class)->group(function () {
    Route::get('/keap/auth', 'auth');
    Route::get('/keap/callback', 'callback');
});
