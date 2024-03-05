<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;

class RestrictByIP
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle($request, Closure $next)
    {
        $allowedIPs = config('app.allowed_ips');

        if (!in_array($request->ip(), $allowedIPs)) {
            $error_message = Response::json(['alert','error','message' => 'Unauthorized Access. Login is only allowed on Campus', 'status'=>403], 403);
            $request->merge(['error' => $error_message]);
        }

        return $next($request);

    }
}
