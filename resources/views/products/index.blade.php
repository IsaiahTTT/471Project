<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart Store</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f4f4;
        }
        header {
            background: #222;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            padding: 30px;
        }
        .product {
            background: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }
        .product img {
            width: 100%;
            height: 180px;
            object-fit: contain;
        }
        .product a {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<header>
    <h1>My Shopping Cart Store</h1>
</header>

<div class="products">
    @forelse($products as $product)
        <div class="product">
            @if($product->image_url)
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
            @endif

            <h2>{{ $product->name }}</h2>
            <p>${{ number_format($product->price, 2) }}</p>

            <a href="{{ route('products.show', $product->sku) }}">
                View Product
            </a>
        </div>
    @empty
        <p>No products available yet.</p>
    @endforelse
</div>

</body>
</html>