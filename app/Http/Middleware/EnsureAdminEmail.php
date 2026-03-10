<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminEmail
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            abort(401);
        }

        $adminEmail = config('services.nothing.admin_email');

        if (! $adminEmail || $user->email !== $adminEmail) {
            abort(403);
        }

        return $next($request);
    }
}
