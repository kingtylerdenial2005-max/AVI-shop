<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClearAdminSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If we are on a public page, clear the admin session
        if (!$request->is('admin/*') && !$request->is('admin')) {
            session()->forget('admin_logged_in');
        }

        return $next($request);
    }
}
