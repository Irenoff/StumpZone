<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureVendor
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        // You already have a "usertype" column (values: admin, vendor, user, etc)
        if (!$user || $user->usertype !== 'vendor') {
            abort(403, 'Only vendors can access this page.');
        }
        return $next($request);
    }
}
