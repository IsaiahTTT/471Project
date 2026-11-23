@extends('layouts.app')

@section('title', 'Edit Product - GameTech')

@section('content')

<a href="{{ route('admin.products.index') }}"
   class="back-link">
    &larr; Back to Product Management
</a>

<div class="page-heading">
    <div>
        <h1>Edit Product</h1>
        <p>Update product details and inventory.</p>
    </div>
</div>

<div class="panel admin-form-panel">

    <form action="{{ route('admin.products.update', $product->sku) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="sku">Product SKU</label>

            <input type="text"
                   id="sku"
                   name="sku"
                   value="{{ $product->sku }}"
                   class="form-control"
                   readonly>

            <small class="form-help">
                The SKU is the product's unique identifier
                and cannot be changed.
            </small>
        </div>

        <div class="form-group">
            <label for="name">Product Name</label>

            <input type="text"
                   id="name"
                   name="name"
                   value="{{ old('name', $product->name) }}"
                   class="form-control"
                   required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>

            <textarea id="description"
                      name="description"
                      rows="5"
                      class="form-control"
                      required>{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="admin-form-row">

            <div class="form-group">
                <label for="price">Price ($)</label>

                <input type="number"
                       id="price"
                       name="price"
                       value="{{ old('price', $product->price) }}"
                       min="0"
                       step="0.01"
                       class="form-control"
                       required>
            </div>

            <div class="form-group">
                <label for="stock">Stock Quantity</label>

                <input type="number"
                       id="stock"
                       name="stock"
                       value="{{ old('stock', $product->stock) }}"
                       min="0"
                       step="1"
                       class="form-control"
                       required>
            </div>

        </div>

        <div class="form-group">
            <label for="image_url">Product Image URL</label>

            <input type="url"
                   id="image_url"
                   name="image_url"
                   value="{{ old('image_url', $product->image_url) }}"
                   class="form-control">

            <small class="form-help">
                Enter a direct URL to the product image.
            </small>
        </div>

        <div class="admin-form-actions">

            <button type="submit" class="btn">
                Save Changes
            </button>

            <a href="{{ route('admin.products.index') }}"
               class="btn btn-secondary">
                Cancel
            </a>

        </div>

    </form>

</div>

@endsection
