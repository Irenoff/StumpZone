<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ADMIN PANEL: USER MANAGEMENT
    |--------------------------------------------------------------------------
    */

    // ✅ Admin dashboard showing all users
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.dashboard', compact('users'));
    }

    // ✅ Store a new user
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'usertype' => 'required|string|in:user,admin',
            'address'  => 'nullable|string|max:255',
        ]);

        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'usertype' => $validated['usertype'],
            'address'  => $validated['address'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }

    // ✅ Delete a user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }

    /*
    |--------------------------------------------------------------------------
    | CUSTOMER PANEL: PUBLIC-FACING DASHBOARD
    |--------------------------------------------------------------------------
    */

    // ✅ Customer homepage (shows random products from all products table)
    public function customerDashboard()
    {
        $items = DB::table('products')->inRandomOrder()->limit(9)->get();
        return view('customer.dashboard', compact('items'));
    }

    /**
     * Reusable loader for sport pages.
     * Adds an "in_cart" boolean using an EXISTS subquery.
     */
    private function loadSportPage(string $sport, string $table, string $view)
    {
        $userId = Auth::id();

        $items = DB::table("$table as p")
            ->select('p.*')
            ->selectRaw(
                'EXISTS (
                    SELECT 1 FROM carts c
                    WHERE c.user_id = ?
                      AND c.sport_type = ?
                      AND c.equipment_id = p.id
                ) AS in_cart',
                [$userId ?? 0, $sport]
            )
            ->get();

        return view("customer.$view", ['items' => $items]);
    }

    // ✅ Individual sport pages (now use the loader above)

    public function cricket()
    {
        return $this->loadSportPage('cricket', 'cricket_equipment', 'cricket');
    }

    public function football()
    {
        return $this->loadSportPage('football', 'football_equipment', 'football');
    }

    public function badminton()
    {
        return $this->loadSportPage('badminton', 'badminton_equipment', 'badminton');
    }

    public function basketball()
    {
        return $this->loadSportPage('basketball', 'basketball_equipment', 'basketball');
    }

    public function boxing()
    {
        return $this->loadSportPage('boxing', 'boxing_equipment', 'boxing');
    }

    public function dashboard()
    {
        return view('welcome');
    }

    // ❌ Session cart kept removed on purpose
}
