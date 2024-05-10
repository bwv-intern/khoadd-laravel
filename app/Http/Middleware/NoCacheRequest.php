<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NoCacheRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        return $response->header('Cache-Control', 'max-age=0, no-cache, no-store')->header('Pragma', 'no-cache')->header('Expire', 'Thu Jan 01 1970 00:00:00 GMT');
    }
}
