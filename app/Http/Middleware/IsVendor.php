<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsVendor
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // Allow both vendors and admins
        if ($user && in_array(strtolower((string) $user->usertype), ['vendor', 'admin'], true)) {
            return $next($request);
        }

        // If not logged in, you can redirect to login instead of 403:
        // return redirect()->route('login');

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Only vendors can access this area.'], 403);
        }

        abort(403, 'Only vendors can access this area.');
    }
}
