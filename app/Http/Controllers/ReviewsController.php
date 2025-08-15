<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewsController extends Controller
{
    /**
     * List reviews. If the user has at least one order,
     * show the create/update form.
     */
    public function index()
    {
        $reviews = Review::with('user:id,name')
            ->latest()
            ->paginate(10);

        $user = Auth::user();

        $canReview = false;
        $myReview = null;

        if ($user) {
            // a user can review if they have at least one order
            $hasOrder = Order::where('user_id', $user->id)->exists();
            $canReview = $hasOrder;

            if ($hasOrder) {
                $myReview = Review::where('user_id', $user->id)->first();
            }
        }

        return view('customer.reviews.index', compact('reviews', 'canReview', 'myReview'));
    }

    /**
     * Store or update a review (only for customers with orders).
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('customer.reviews')->with('error', 'You must be logged in.');
        }

        $hasOrder = Order::where('user_id', $user->id)->exists();
        if (!$hasOrder) {
            return redirect()->route('customer.reviews')->with('error', 'Only customers who have placed orders can write reviews.');
        }

        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'title'  => 'nullable|string|max:120',
            'body'   => 'nullable|string|max:2000',
        ]);

        $review = Review::firstOrNew(['user_id' => $user->id]);
        $review->fill([
            'rating' => $data['rating'],
            'title'  => $data['title'] ?? null,
            'body'   => $data['body'] ?? null,
        ]);
        $review->save();

        return redirect()
            ->route('customer.reviews')
            ->with('success', $review->wasRecentlyCreated ? 'Review submitted. Thank you!' : 'Review updated.');
    }
}
