<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
                         ->with('success', 'Product deleted successfully.');
    }


    public function store(Request $request)
{
    $request->validate([
        'name_of_products' => 'required|string',
        'type' => 'required|string',
        'photo_product' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->all();

    // Check if a file is uploaded
    if ($request->hasFile('photo_product')) {
        $imagePath = $request->file('photo_product')->store('images', 'public');
        $data['photo_product'] = $imagePath;
    }

    Product::create($data);

    return redirect()->route('products.index')
                     ->with('success', 'Product created successfully.');
}

public function update(Request $request, Product $product)
{
    $request->validate([
        'name_of_products' => 'required|string',
        'type' => 'required|string',
        'photo_product' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->all();

    // Check if a new file is uploaded
    if ($request->hasFile('photo_product')) {
        $imagePath = $request->file('photo_product')->store('images', 'public');
        $data['photo_product'] = $imagePath;

        // Optionally delete the old photo file if it exists
        if ($product->photo_product && \Storage::disk('public')->exists($product->photo_product)) {
            \Storage::disk('public')->delete($product->photo_product);
        }
    }

    $product->update($data);

    return redirect()->route('products.index')
                     ->with('success', 'Product updated successfully.');
}

}
