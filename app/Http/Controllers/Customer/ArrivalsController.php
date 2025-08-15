<?php



namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Arrival;
use Illuminate\Http\Request;

class ArrivalsController extends Controller
{
    public function index(Request $request)
    {
        $query = Arrival::query()
            ->where('status', 'active');

        // Filter by sport (optional)
        if ($request->filled('sport') && in_array($request->sport, ['cricket','football','basketball','badminton','boxing'])) {
            $query->where('sport', $request->sport);
        }

        // Text search (optional) - title/description
        if ($request->filled('q')) {
            $q = trim($request->q);
            $query->where(function($qq) use ($q) {
                $qq->where('title', 'ILIKE', "%{$q}%")
                   ->orWhere('description', 'ILIKE', "%{$q}%");
            });
        }

        // Order newest first
        $arrivals = $query->orderByDesc('created_at')
                          ->paginate(12)
                          ->withQueryString();

        return view('customer.arrivals', compact('arrivals'));
    }
}
