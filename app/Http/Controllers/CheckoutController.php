<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function paymentPage(Request $request)
    {
        $ids = $request->input('selected', []);
        $quantities = $request->input('quantities', []);

        if (!is_array($ids) || empty($ids)) {
            return redirect()->route('cart.view')->with('error', 'Select at least one item to continue.');
        }

        $cartRows = DB::table('carts')
            ->where('user_id', Auth::id())
            ->whereIn('id', array_map('intval', $ids))
            ->get();

        if ($cartRows->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'No valid items selected.');
        }

        $items = [];
        $total = 0;

        foreach ($cartRows as $cart) {
            $table = $this->getTableFromSport($cart->sport_type);
            $product = DB::table($table)->where('id', $cart->equipment_id)->first();
            if (!$product) continue;

            // Check stock
            $requestedQty = isset($quantities[$cart->id]) ? (int)$quantities[$cart->id] : $cart->quantity;
            if ($requestedQty > $product->quantity) {
                return redirect()->route('cart.view')
                    ->with('error', "Only {$product->quantity} items are left in stock for {$product->name}.");
            }

            // Update cart quantity to match selection
            DB::table('carts')->where('id', $cart->id)->update([
                'quantity' => $requestedQty,
                'updated_at' => now(),
            ]);

            $price    = (float)($product->price ?? 0);
            $subtotal = $price * $requestedQty;
            $total   += $subtotal;

            $items[] = (object)[
                'cart_id'     => $cart->id,
                'sport_type'  => $cart->sport_type,
                'name'        => $product->name ?? 'Item',
                'size'        => $product->size ?? 'N/A',
                'price'       => $price,
                'quantity'    => $requestedQty,
                'subtotal'    => $subtotal,
                'stock'       => $product->quantity ?? 0,
            ];
        }

        return view('customer.cart.payment', [
            'items' => $items,
            'total' => $total,
            'selected' => $ids,
        ]);
    }

    public function pay(Request $request)
    {
        $request->validate([
            'selected'   => ['required','array','min:1'],
            'selected.*' => ['integer','min:1'],
        ]);

        // Payment logic here later
        return redirect()
            ->route('cart.view')
            ->with('success', 'Payment flow stub: implement your gateway logic next.');
    }

    private function getTableFromSport(string $sportType): string
    {
        return match (strtolower($sportType)) {
            'cricket'    => 'cricket_equipment',
            'football'   => 'football_equipment',
            'basketball' => 'basketball_equipment',
            'badminton'  => 'badminton_equipment',
            'boxing'     => 'boxing_equipment',
            default      => throw new \RuntimeException("Unknown sport type: {$sportType}"),
        };
    }
}
