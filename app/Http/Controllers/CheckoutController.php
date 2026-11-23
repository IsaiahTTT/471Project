<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::with('items.product')
            ->where('user_id', Auth::id())
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                ->withErrors(['cart' => 'Your cart is empty.']);
        }

        $total = $cart->items->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'shipping_name' => 'required|string|max:255',
            'shipping_address' => 'required|string|max:255',
            'shipping_city' => 'required|string|max:255',
            'shipping_state' => 'required|string|max:100',
            'shipping_zip' => 'required|string|max:20',
        ]);

        $order = DB::transaction(function () use ($data) {

            $cart = Cart::where('user_id', Auth::id())
                ->first();

            if (!$cart) {
                throw ValidationException::withMessages([
                    'cart' => 'Your cart is empty.',
                ]);
            }

            $items = $cart->items()
                ->orderBy('sku')
                ->get();

            if ($items->isEmpty()) {
                throw ValidationException::withMessages([
                    'cart' => 'Your cart is empty.',
                ]);
            }

            $totalCents = 0;
            $purchases = [];

            foreach ($items as $item) {
                $product = Product::where('sku', $item->sku)
                    ->lockForUpdate()
                    ->firstOrFail();

                if ($item->quantity > $product->stock) {
                    throw ValidationException::withMessages([
                        'stock' => 'Not enough stock for ' . $product->name,
                    ]);
                }

                $priceCents = (int) round($product->price * 100);

                $totalCents += $priceCents * $item->quantity;

                $purchases[] = [
                    'product' => $product,
                    'quantity' => $item->quantity,
                    'unit_price' => $product->price,
                ];
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'order_date' => now(),
                'total_amount' => $totalCents / 100,
                'status' => 'pending',
                ...$data,
            ]);

            foreach ($purchases as $purchase) {
                OrderItem::create([
                    'order_id' => $order->order_id,
                    'sku' => $purchase['product']->sku,
                    'quantity' => $purchase['quantity'],
                    'unit_price' => $purchase['unit_price'],
                ]);

                $purchase['product']->decrement(
                    'stock',
                    $purchase['quantity']
                );
            }

            $cart->items()->delete();

            return $order;
        });

        return redirect()
            ->route('orders.show', $order->order_id)
            ->with('success', 'Order placed successfully!');
    }
}
