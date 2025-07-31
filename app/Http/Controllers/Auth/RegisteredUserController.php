<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1) Validate name, email, address, and password
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'address'  => ['required', 'string', 'max:500'],          // ← added
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2) Create the user, including address
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'address'  => $request->address,                         // ← added
            'password' => Hash::make($request->password),
        ]);

        // 3) Fire the Registered event, log them in, and redirect
        event(new Registered($user));
        Auth::login($user);

        return redirect(route('dashboard'));
    }
}
