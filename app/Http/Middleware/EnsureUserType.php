<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$types): Response
    {
        // Block anyone who is not logged in, or whose user_type is not in the allowed list
        if (! $request->user() || ! in_array($request->user()->user_type, $types)) {
            abort(403);
        }

        return $next($request);
    }

}
