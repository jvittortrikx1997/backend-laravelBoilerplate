<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

route::middleware(['auth:api'])->group(function (): void {
    require_once __DIR__ . '/user.php';
    require_once __DIR__ . '/auth.php';
});
