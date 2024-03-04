<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class AuthenticateApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // List of routes that don't require authentication
        $allowedRoutes = [
            'books.byShelfName',
            'books.byID',
        ];

        // Check if the current route is in the list of allowed routes
        if (!$request->user() && !in_array($request->route()->getName(), $allowedRoutes)) {
            return response()->json(['type'=>'modal','level'=>'error','message' => 'Unauthorized. Please log in.'], 401);
        }

        return $next($request);
    }
}
