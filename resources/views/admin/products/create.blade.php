@extends('layouts.app')

@section('title', 'Add Product - GameTech')

@section('content')

<a href="{{ route('admin.products.index') }}"
   class="back-link">
    &larr; Back to Product Management
</a>

<div class="page-heading">
    <div>
        <h1>Add New Product</h1>
        <p>Create a new product for your GameTech store.</p>
    </div>
</div>

<div class="panel admin-form-panel">

    <form action="{{ route('admin.products.store') }}"
          method="POST">

        @csrf

        <div class="form-group">
            <label for="sku">Product SKU</label>

            <input type="text"
                   id="sku"
                   name="sku"
                   value="{{ old('sku') }}"
                   class="form-control"
                   maxlength="255"
                   required>

            <small class="form-help">
                Enter a unique product identifier,
                such as GAM011.
            </small>
        </div>

        <div class="form-group">
            <label for="name">Product Name</label>

            <input type="text"
                   id="name"
                   name="name"
                   value="{{ old('name') }}"
                   class="form-control"
                   maxlength="255"
                   required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>

            <textarea id="description"
                      name="description"
                      rows="5"
                      class="form-control"
                      required>{{ old('description') }}</textarea>
        </div>

        <div class="admin-form-row">

            <div class="form-group">
                <label for="price">Price ($)</label>

                <input type="number"
                       id="price"
                       name="price"
                       value="{{ old('price') }}"
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
                       value="{{ old('stock', 0) }}"
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
                   value="{{ old('image_url') }}"
                   class="form-control"
                   placeholder="https://example.com/image.jpg">

            <small class="form-help">
                Optional. Enter a direct URL to a product image.
            </small>
        </div>

        <div class="admin-form-actions">

            <button type="submit" class="btn">
                Save Product
            </button>

            <a href="{{ route('admin.products.index') }}"
               class="btn btn-secondary">
                Cancel
            </a>

        </div>

    </form>

</div>

@endsection
