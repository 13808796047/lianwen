<?php

namespace App\Http\Middleware;

use Closure;

class VerificationHasPhone
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
