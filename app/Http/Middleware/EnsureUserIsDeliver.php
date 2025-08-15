<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsDeliver
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if (!$user) {
            return redirect()->route('login');
        }

        // NOTE: your column is "usertype"
        $type = strtolower((string)($user->usertype ?? ''));

        if ($type !== 'deliver') {
            // You can redirect somewhere else instead of abort, if you want.
            abort(403, 'Only users with the Deliver role may access this page.');
        }

        return $next($request);
    }
}
