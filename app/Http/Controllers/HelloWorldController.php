<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\HelloWorldService;
use Symfony\Component\HttpFoundation\JsonResponse;

class HelloWorldController extends Controller
{
    public function get(): JsonResponse
    {

        $helloWorldService = new HelloWorldService();

        return response()->json($helloWorldService->get());
    }
}
