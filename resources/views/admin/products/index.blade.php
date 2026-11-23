@extends('layouts.app')

@section('title', 'Manage Products - GameTech')

@section('content')

<div class="page-heading">
    <div>
        <h1>Product Management</h1>
        <p>Manage your GameTech store inventory.</p>
    </div>

    <a href="{{ route('admin.products.create') }}"
       class="btn">
        + Add New Product
    </a>
</div>

<div class="admin-stats">

    <div class="panel admin-stat-card">
        <span>Total Products</span>
        <strong>{{ $products->count() }}</strong>
    </div>

    <div class="panel admin-stat-card">
        <span>Total Units in Stock</span>
        <strong>{{ $products->sum('stock') }}</strong>
    </div>

    <div class="panel admin-stat-card">
        <span>Out of Stock</span>
        <strong>{{ $products->where('stock', 0)->count() }}</strong>
    </div>

</div>

<div class="panel">

    <div class="orders-header">
        <h2>Inventory</h2>

        <a href="{{ route('products.index') }}"
           class="btn btn-secondary">
            View Storefront
        </a>
    </div>

    <div class="table-wrap">

        <table class="admin-products-table">

            <thead>
                <tr>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($products as $product)

                    <tr>

                        <td>
                            <div class="cart-product">

                                @if($product->image_url)
                                    <img
                                        src="{{ $product->image_url }}"
                                        alt="{{ $product->name }}"
                                        class="cart-product-image">
                                @endif

                                <div>
                                    <strong>
                                        {{ $product->name }}
                                    </strong>

                                    <p class="cart-product-sku">
                                        {{ \Illuminate\Support\Str::limit(
                                            $product->description, 55
                                        ) }}
                                    </p>
                                </div>

                            </div>
                        </td>

                        <td>{{ $product->sku }}</td>

                        <td class="order-amount">
                            ${{ number_format($product->price, 2) }}
                        </td>

                        <td>
                            @if($product->stock > 0)
                                <span class="admin-stock in-stock">
                                    {{ $product->stock }} Available
                                </span>
                            @else
                                <span class="admin-stock no-stock">
                                    Out of Stock
                                </span>
                            @endif
                        </td>

                        <td>
                            <div class="admin-actions">

                                <a href="{{ route('admin.products.edit', $product->sku) }}"
                                   class="btn btn-secondary">
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.products.destroy', $product->sku) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this product?')">
                                        Delete
                                    </button>

                                </form>

                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5">
                            No products available.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
