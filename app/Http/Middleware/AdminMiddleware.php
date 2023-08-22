<?php

declare(strict_types=1);


namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class AdminMiddleware
{

    public function handle(Request $request,Closure $next): Response
    {
        /* @var User $user */
        $user = auth()->user();

        if ($user->role->title !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }

}
