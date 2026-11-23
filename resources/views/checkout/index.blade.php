@extends('layouts.app')

@section('title', 'Checkout - GameTech')

@section('content')

<div class="page-heading">
    <div>
        <h1>Checkout</h1>
        <p>Almost there! Review your order and enter your shipping details.</p>
    </div>

    <a href="{{ route('cart.index') }}"
       class="btn btn-secondary">
        &larr; Back to Cart
    </a>
</div>

<form action="{{ route('checkout.store') }}"
      method="POST"
      id="checkout-form">

    @csrf

    <div class="checkout-layout">

        <!-- Shipping Information -->

        <div class="panel checkout-shipping">

            <h2>Shipping Information</h2>

            <p class="checkout-description">
                Enter the address where you would like
                your order to be delivered.
            </p>

            <div class="form-group">
                <label for="shipping_name">
                    Full Name
                </label>

                <input type="text"
                       id="shipping_name"
                       name="shipping_name"
                       value="{{ old('shipping_name') }}"
                       class="form-control"
                       autocomplete="name"
                       maxlength="255"
                       required>
            </div>

            <div class="form-group">
                <label for="shipping_address">
                    Street Address
                </label>

                <input type="text"
                       id="shipping_address"
                       name="shipping_address"
                       value="{{ old('shipping_address') }}"
                       class="form-control"
                       autocomplete="street-address"
                       maxlength="255"
                       required>
            </div>

            <div class="form-group">
                <label for="shipping_city">
                    City
                </label>

                <input type="text"
                       id="shipping_city"
                       name="shipping_city"
                       value="{{ old('shipping_city') }}"
                       class="form-control"
                       autocomplete="address-level2"
                       maxlength="255"
                       required>
            </div>

            <div class="checkout-address-row">

                <div class="form-group">
                    <label for="shipping_state">
                        State
                    </label>

                    <input type="text"
                           id="shipping_state"
                           name="shipping_state"
                           value="{{ old('shipping_state') }}"
                           class="form-control"
                           autocomplete="address-level1"
                           maxlength="100"
                           required>
                </div>

                <div class="form-group">
                    <label for="shipping_zip">
                        ZIP Code
                    </label>

                    <input type="text"
                           id="shipping_zip"
                           name="shipping_zip"
                           value="{{ old('shipping_zip') }}"
                           class="form-control"
                           autocomplete="postal-code"
                           maxlength="20"
                           required>
                </div>

            </div>

            <div class="checkout-info">
                <strong>Demo Checkout</strong>
                <p>
                    This is a class project. No actual
                    payment will be processed or products shipped.
                </p>
            </div>

        </div>

        <!-- Order Summary -->

        <aside class="panel checkout-summary">

            <h2>Order Summary</h2>

            <div class="checkout-items">

                @foreach($cart->items as $item)

                    <div class="checkout-item">

                        @if($item->product->image_url)
                            <img
                                src="{{ $item->product->image_url }}"
                                alt="{{ $item->product->name }}"
                                class="checkout-item-image">
                        @endif

                        <div class="checkout-item-info">

                            <strong>
                                {{ $item->product->name }}
                            </strong>

                            <span>
                                Quantity: {{ $item->quantity }}
                            </span>

                            <span>
                                ${{ number_format(
                                    $item->product->price, 2
                                ) }} each
                            </span>

                        </div>

                        <div class="checkout-item-price">
                            ${{ number_format(
                                $item->quantity * $item->product->price,
                                2
                            ) }}
                        </div>

                    </div>

                @endforeach

            </div>

            <hr>

            <div class="summary-row">
                <span>Items</span>
                <span>{{ $cart->items->sum('quantity') }}</span>
            </div>

            <div class="summary-row">
                <span>Subtotal</span>
                <span>${{ number_format($total, 2) }}</span>
            </div>

            <div class="summary-row">
                <span>Shipping</span>
                <span>Not calculated</span>
            </div>

            <div class="summary-row">
                <span>Taxes</span>
                <span>Not calculated</span>
            </div>

            <hr>

            <div class="summary-row summary-total">
                <span>Total</span>
                <span>${{ number_format($total, 2) }}</span>
            </div>

            <p class="summary-note">
                The total includes product prices only.
                Shipping and taxes are not calculated
                in this demo store.
            </p>

            <button type="submit"
                    class="btn checkout-btn"
                    id="place-order-btn">
                Place Order
            </button>

            <p class="checkout-secure-note">
                Your order will be saved to your account.
                No payment information is required.
            </p>

        </aside>

    </div>

</form>

@endsection
