<?php

namespace App\Http\Controllers;

use App\Models\BasicProductsPrice;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
class AdminController extends Controller
{
    public function index(){

    }

    // public function create_user(Request $request){
    //     $user create([]);

    // }


    public function create_product(Request $request){
        return BasicProductsPrice::create($request->query->all());
    }



    public function storeProduct(Request $request)
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

    BasicProductsPrice::create($data);

    return redirect()->back()
                     ->with('success', 'Product created successfully.');
}

public function update(Request $request, BasicProductsPrice $product)
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


public function sellProduct(Request $request, $productId)
{
    $request->validate([
        'quantity' => 'required|numeric|min:0.01',
        'price' => 'required|integer|min:1',
    ]);

    $product = Product::findOrFail($productId);

    if ($product->quantity < $request->quantity) {
        return response()->json(['error' => 'Not enough stock available'], 400);
    }

    // Reduce the product quantity
    $product->quantity -= $request->quantity;
    $product->save();

    // Create a new sale record
    $sale = new Sales();
    $sale->product_id = $product->id;
    $sale->quantity_sold = $request->quantity;
    $sale->price_at_sale = $request->price;
    $sale->save();

    return response()->json(['message' => 'Product sold successfully', 'sale' => $sale]);
}


}
