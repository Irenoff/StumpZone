<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ReviewsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->input('per_page', 15);

        // Build base query
        $query = DB::table('reviews');

        // Join users only if reviews.user_id exists
        if (Schema::hasColumn('reviews', 'user_id')) {
            $query->leftJoin('users', 'reviews.user_id', '=', 'users.id')
                  ->addSelect('users.name as u_name', 'users.email as u_email');
        }

        // (Optional) Only join products if reviews.product_id exists
        if (Schema::hasColumn('reviews', 'product_id')) {
            $query->leftJoin('products', 'reviews.product_id', '=', 'products.id')
                  ->addSelect('products.name as p_name', 'products.title as p_title');
        }

        $query->addSelect('reviews.*');

        $paginator = $query->orderBy('reviews.created_at', 'desc')->paginate($perPage);

        // Normalize fields on the collection (no assumptions about column names)
        $items = $paginator->getCollection()->map(function ($r) {
            $row = (array) $r;

            $first = function (array $keys) use ($row) {
                foreach ($keys as $k) {
                    if (array_key_exists($k, $row) && isset($row[$k]) && trim((string) $row[$k]) !== '') {
                        return $row[$k];
                    }
                }
                return null;
            };

            // Name from users table or fallback columns in reviews
            $displayName = $first(['u_name', 'user_name', 'customer_name', 'full_name', 'name', 'username', 'reviewer', 'author']);
            if (!$displayName) {
                $fn = $first(['first_name']);
                $ln = $first(['last_name']);
                $displayName = trim(($fn ?? '') . ' ' . ($ln ?? ''));
            }
            if ($displayName === '') {
                $displayName = 'Anonymous';
            }

            // Comment / review body (check many possible fields)
            $displayComment = $first(['comment', 'comments', 'review', 'message', 'content', 'body', 'text', 'description']) ?? '';

            // Rating from whatever field exists
            $displayRating = $first(['rating', 'stars', 'score', 'value', 'rate']);

            // Product (optional)
            $displayProduct = $first(['p_name', 'p_title', 'product_name', 'product']);

            // Attach normalized fields
            $r->display_name    = $displayName;
            $r->display_comment = $displayComment;
            $r->display_rating  = $displayRating;
            $r->display_product = $displayProduct;

            return $r;
        });

        $paginator->setCollection($items);

        return view('vendor_panel.reviews.index', ['reviews' => $paginator]);
    }
}
