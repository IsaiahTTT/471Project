@extends('layouts.app')

@section('title', $product->name . ' - GameTech')

@section('content')

<a href="{{ route('products.index') }}"
   class="back-link">
    &larr; Back to Products
</a>

<div class="product-detail">

    <div class="product-detail-image">

        @if($product->image_url)
            <img src="{{ $product->image_url }}"
                 alt="{{ $product->name }}">
        @else
            <div class="no-image">
                No Image Available
            </div>
        @endif

    </div>

    <div class="product-detail-info">

        <p class="product-sku">
            SKU: {{ $product->sku }}
        </p>

        <h1>{{ $product->name }}</h1>

        <div class="detail-price">
            ${{ number_format($product->price, 2) }}
        </div>

        @if($product->stock > 0)
            <p class="stock">
                In Stock - {{ $product->stock }} available
            </p>
        @else
            <p class="stock out-of-stock">
                Currently Out of Stock
            </p>
        @endif

        <hr>

        <h3>Product Description</h3>

        <p class="detail-description">
            {{ $product->description }}
        </p>

        @if($product->stock > 0)

            <form action="{{ route('cart.add', $product->sku) }}"
                  method="POST"
                  class="add-cart-form">

                @csrf

                <div class="form-group">
                    <label for="quantity">
                        Quantity
                    </label>

                    <input type="number"
                           id="quantity"
                           name="quantity"
                           value="1"
                           min="1"
                           max="{{ $product->stock }}"
                           class="form-control quantity-input"
                           required>
                </div>

                <button type="submit"
                        class="btn add-cart-btn">
                    Add to Cart
                </button>

            </form>

        @else

            <button class="btn"
                    disabled
                    style="background:#94a3b8;cursor:not-allowed;">
                Out of Stock
            </button>

        @endif

        <div class="product-actions">
            <a href="{{ route('cart.index') }}"
               class="btn btn-secondary">
                View My Cart
            </a>

            <a href="{{ route('products.index') }}"
               class="btn btn-secondary">
                Continue Shopping
            </a>
        </div>

    </div>

</div>

@endsection
