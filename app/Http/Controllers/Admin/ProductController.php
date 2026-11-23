<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('name')->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'sku' => 'required|string|max:255|unique:products,sku',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|url|max:2048',
            'stock' => 'required|integer|min:0',
        ]);

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

   
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
        public function update(Request $request, Product $product)
        {
        $data = $request->validate([
            'sku' => ['required', 'string', 'max:255', Rule::unique('products', 'sku')->ignore($product->sku, 'sku')],
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|url|max:2048',
            'stock' => 'required|integer|min:0',
        ]);

        unset($data['sku']); // Prevent SKU from being updated

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->cartItems()->exists() || $product->orderItems()->exists()) {
            return back()->withErrors(['product' => 'Cannot delete product because it is associated with existing cart or order items.']);
        }

         $product->delete();

    return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
