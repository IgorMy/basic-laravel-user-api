<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HealthCheckController extends Controller
{
    public function __invoke(Request $request): Response
    {
        return response()->noContent(status: Response::HTTP_OK);
    }
}
