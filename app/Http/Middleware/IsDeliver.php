<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsDeliver
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if (!$user) {
            return redirect()->route('login');
        }

        // your column is "usertype" (not user_type)
        if (strtolower((string)($user->usertype ?? '')) !== 'deliver') {
            abort(403, 'Only Deliver users can access this page.');
        }

        return $next($request);
    }
}
