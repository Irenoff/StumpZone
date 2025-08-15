<?php



namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Get latest items from each sport table (adjust table names if needed)
        $cricket    = DB::table('cricket')->select('id','name','price','image_path','sport','stock','created_at')->latest()->take(4)->get();
        $football   = DB::table('football')->select('id','name','price','image_path','sport','stock','created_at')->latest()->take(4)->get();
        $basketball = DB::table('basketball')->select('id','name','price','image_path','sport','stock','created_at')->latest()->take(4)->get();
        $badminton  = DB::table('badminton')->select('id','name','price','image_path','sport','stock','created_at')->latest()->take(4)->get();
        $boxing     = DB::table('boxing')->select('id','name','price','image_path','sport','stock','created_at')->latest()->take(4)->get();

        // Merge all into one collection
        $items = collect()
            ->merge($cricket)
            ->merge($football)
            ->merge($basketball)
            ->merge($badminton)
            ->merge($boxing)
            ->sortByDesc('created_at')
            ->values();

        return view('admin.cricket.dashboard', compact('items'));
    }
}
