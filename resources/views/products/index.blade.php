@extends('layouts.app')

@section('title', 'Shop Gaming Electronics - GameTech')

@section('content')

<section class="hero">
    <h1>Upgrade Your Gaming Setup</h1>

    <p>
        Discover gaming accessories, peripherals,
        and electronics designed to take your
        setup to the next level.
    </p>
</section>

<h2 class="section-heading">
    Shop Our Products
</h2>

<div class="product-grid">

    @forelse($products as $product)

        <div class="product-card">

            @if($product->image_url)
                <img
                    src="{{ $product->image_url }}"
                    alt="{{ $product->name }}"
                    class="product-image">
            @else
                <div class="product-image">
                    No Image Available
                </div>
            @endif

            <div class="product-content">

                <h3>{{ $product->name }}</h3>

                <p class="product-description">
                    {{ \Illuminate\Support\Str::limit(
                        $product->description, 85
                    ) }}
                </p>

                <div class="price">
                    ${{ number_format($product->price, 2) }}
                </div>

                @if($product->stock > 0)
                    <p class="stock">
                        In Stock ({{ $product->stock }})
                    </p>
                @else
                    <p class="stock out-of-stock">
                        Out of Stock
                    </p>
                @endif

                <a href="{{ route('products.show', $product->sku) }}"
                   class="btn">
                    View Product
                </a>

            </div>
        </div>

    @empty

        <p>No products available.</p>

    @endforelse

</div>

@endsection
