<?php

declare (strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class HealthCheckController extends Controller
{
    public function __invoke(Request $request): Response
    {
        return response()->noContent(status: Response::HTTP_OK);
    }

}
