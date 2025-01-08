<?php

use App\Http\Controllers\UserCreateController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function (): void {
    Route::post('create', UserCreateController::class)->withoutMiddleware('jwtauth');
});
