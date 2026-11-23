@extends('layouts.app')

@section('title', 'My Orders - GameTech')

@section('content')

<div class="page-heading">
    <div>
        <h1>My Orders</h1>
        <p>View your previous purchases and order details.</p>
    </div>

    <a href="{{ route('products.index') }}"
       class="btn btn-secondary">
        Continue Shopping
    </a>
</div>

@if($orders->isEmpty())

    <div class="panel empty-orders">
        <div class="empty-orders-icon">📦</div>

        <h2>No Orders Yet</h2>

        <p>
            You haven't placed any orders yet.
            Browse our gaming products to get started.
        </p>

        <a href="{{ route('products.index') }}"
           class="btn">
            Shop Now
        </a>
    </div>

@else

    <div class="panel">

        <div class="orders-header">
            <h2>Order History</h2>

            <span class="orders-count">
                {{ $orders->count() }}
                {{ $orders->count() === 1 ? 'Order' : 'Orders' }}
            </span>
        </div>

        <div class="table-wrap">
            <table class="orders-table">

                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Date Placed</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Details</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td class="order-number">
                                #{{ $order->order_id }}
                            </td>

                            <td>
                                {{ \Illuminate\Support\Carbon::parse($order->order_date)->format('M d, Y') }}
                            </td>

                            <td class="order-amount">
                                ${{ number_format($order->total_amount, 2) }}
                            </td>

                            <td>
                                <span class="order-status">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('orders.show', $order->order_id) }}"
                                   class="btn btn-secondary">
                                    View Details
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>

@endif

@endsection
