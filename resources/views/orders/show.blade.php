<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Details</title>
</head>
<body style="font-family: Arial; padding: 30px;">

<a href="{{ route('orders.index') }}">
    Back to Order History
</a>

<h1>Order #{{ $order->order_id }}</h1>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<p>Date: {{ $order->order_date }}</p>
<p>Status: {{ ucfirst($order->status) }}</p>

<h2>Shipping Information</h2>

<p>{{ $order->shipping_name }}</p>
<p>{{ $order->shipping_address }}</p>
<p>
    {{ $order->shipping_city }},
    {{ $order->shipping_state }}
    {{ $order->shipping_zip }}
</p>

<h2>Purchased Products</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Unit Price</th>
        <th>Subtotal</th>
    </tr>

    @foreach($order->items as $item)
        <tr>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>${{ number_format($item->unit_price, 2) }}</td>
            <td>
                ${{ number_format(
                    $item->unit_price * $item->quantity,
                    2
                ) }}
            </td>
        </tr>
    @endforeach
</table>

<h2>Total: ${{ number_format($order->total_amount, 2) }}</h2>

<p><small>Demo order — payment not processed.</small></p>

</body>
</html>
