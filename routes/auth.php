<?php

use App\Http\Controllers\AuthLoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function(): void {
    Route::post('login', AuthLoginController::class)->withoutMiddleware('auth:api');

});

