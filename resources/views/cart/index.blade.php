@extends('layouts.app')

@section('title', 'My Shopping Cart - GameTech')

@section('content')

<div class="cart-page">

    <div class="page-heading">
        <div>
            <h1>My Shopping Cart</h1>
            <p>Review your items before checkout.</p>
        </div>

        <a href="{{ route('products.index') }}"
           class="btn btn-secondary">
            Continue Shopping
        </a>
    </div>

    @if($items->isEmpty())

        <div class="panel empty-cart">
            <div class="empty-cart-icon">🛒</div>

            <h2>Your cart is empty</h2>

            <p>
                Looks like you haven't added any
                products to your cart yet.
            </p>

            <a href="{{ route('products.index') }}"
               class="btn">
                Browse Products
            </a>
        </div>

    @else

        <div class="cart-layout">

            <div class="panel cart-items-panel">

                <h2>
                    Cart Items ({{ $items->sum('quantity') }})
                </h2>

                <div class="table-wrap">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>
                                        <div class="cart-product">

                                            @if($item->product->image_url)
                                                <img
                                                    src="{{ $item->product->image_url }}"
                                                    alt="{{ $item->product->name }}"
                                                    class="cart-product-image">
                                            @endif

                                            <div>
                                                <a href="{{ route('products.show', $item->product->sku) }}"
                                                   class="cart-product-name">
                                                    {{ $item->product->name }}
                                                </a>

                                                <p class="cart-product-sku">
                                                    SKU: {{ $item->product->sku }}
                                                </p>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        ${{ number_format($item->product->price, 2) }}
                                    </td>

                                    <td>
                                        <form
                                            action="{{ route('cart.update', $item->cart_item_id) }}"
                                            method="POST"
                                            class="cart-quantity-form">

                                            @csrf
                                            @method('PATCH')

                                            <input
                                                type="number"
                                                name="quantity"
                                                value="{{ $item->quantity }}"
                                                min="1"
                                                max="{{ $item->product->stock }}"
                                                class="form-control cart-quantity-input"
                                                required>

                                            <button type="submit"
                                                    class="btn btn-secondary">
                                                Update
                                            </button>

                                        </form>
                                    </td>

                                    <td class="cart-subtotal">
                                        ${{ number_format(
                                            $item->quantity * $item->product->price,
                                            2
                                        ) }}
                                    </td>

                                    <td>
                                        <form
                                            action="{{ route('cart.remove', $item->cart_item_id) }}"
                                            method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger"
                                                    onclick="return confirm('Remove this product from your cart?')">
                                                Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

            <aside class="panel cart-summary">

                <h2>Order Summary</h2>

                <div class="summary-row">
                    <span>Items</span>
                    <span>{{ $items->sum('quantity') }}</span>
                </div>

                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>

                <div class="summary-row">
                    <span>Shipping</span>
                    <span>Not calculated</span>
                </div>

                <hr>

                <div class="summary-row summary-total">
                    <span>Total</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>

                <p class="summary-note">
                    This is a demo checkout.
                    No real payment will be collected.
                    Shipping charges and taxes are not included.
                </p>

                <a href="{{ route('checkout.index') }}"
                   class="btn checkout-btn">
                    Proceed to Checkout
                </a>

            </aside>

        </div>

    @endif

</div>

@endsection
