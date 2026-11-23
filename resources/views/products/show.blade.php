<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
</head>
<body style="font-family: Arial; padding: 30px;">

    <a href="{{ route('products.index') }}">Back to Products</a>

    <h1>{{ $product->name }}</h1>

    @if($product->image_url)
        <img src="{{ $product->image_url }}"
             alt="{{ $product->name }}"
             width="300">
    @endif

    <p>{{ $product->description }}</p>

    <h2>${{ number_format($product->price, 2) }}</h2>

    <p>Available Stock: {{ $product->stock }}</p>

    <button disabled>Add to Cart (Coming Soon)</button>

</body>
</html>