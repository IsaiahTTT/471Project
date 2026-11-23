<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    private function getCart()
    {
        return Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);
    }

    public function index()
    {
        $cart = $this->getCart();

        $items = CartItem::with('product')
            ->where('cart_id', $cart->cart_id)
            ->get();

        $total = $items->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('cart.index', compact('items', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $data = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($product, $data) {
            $cart = $this->getCart();

            $item = CartItem::firstOrNew([
                'cart_id' => $cart->cart_id,
                'sku' => $product->sku,
            ]);

            $newQuantity = ($item->exists ? $item->quantity : 0)
                + $data['quantity'];

            if ($newQuantity > $product->stock) {
                throw ValidationException::withMessages([
                    'quantity' => 'Not enough stock available.',
                ]);
            }

            $item->quantity = $newQuantity;
            $item->save();
        });

        return redirect()->route('cart.index')
            ->with('success', 'Product added to cart!');
    }

    public function update(Request $request, CartItem $item)
    {
        $data = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        abort_unless(
            $item->cart->user_id === Auth::id(),
            403
        );

        if ($data['quantity'] > $item->product->stock) {
            return back()->withErrors([
                'quantity' => 'Not enough stock available.',
            ]);
        }

        $item->update([
            'quantity' => $data['quantity'],
        ]);

        return back()->with('success', 'Cart updated!');
    }

    public function remove(CartItem $item)
    {
        abort_unless(
            $item->cart->user_id === Auth::id(),
            403
        );

        $item->delete();

        return back()->with('success', 'Product removed!');
    }
}
