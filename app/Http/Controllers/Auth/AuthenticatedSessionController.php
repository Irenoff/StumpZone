<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate via the form request
        $request->authenticate();

        // Regenerate the session ID
        Session::regenerate();

        // Fetch role via the Auth facade
        $usertype = Auth::user()->usertype;

        // Redirect based on role
        if ($usertype === 'admin') {
            return redirect()->route('admin.home');

        }

        return redirect('/dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Log out the user
        Auth::logout();

        // Invalidate and regenerate session CSRF token
        Session::invalidate();
        Session::regenerateToken();

        return redirect('/');
    }
}
