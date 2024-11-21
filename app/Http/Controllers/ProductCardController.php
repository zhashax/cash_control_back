<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCard;
use App\Services\ProductCardService;

class ProductCardController extends Controller
{
    protected $productCardService;

    public function __construct(ProductCardService $productCardService)
    {
        $this->productCardService = $productCardService;
    }

    public function store(Request $request)
{
    $request->validate([
        'name_of_products' => 'required|string',
        'description' => 'nullable|string',
        'country' => 'nullable|string',
        'type' => 'nullable|string',
        'brutto' => 'required|numeric',
        'netto' => 'required|numeric',
        'photo_product' => 'nullable|file|mimes:jpeg,png,jpg,gif',
    ]);

    $data = $request->only(['name_of_products', 'description', 'country', 'type', 'brutto', 'netto']);

    if ($request->hasFile('photo_product')) {
        $filePath = $request->file('photo_product')->store('products', 'public');
        $data['photo_product'] = $filePath;
    }

    $product = ProductCard::create($data);

    return response()->json($product, 201);
}

    public function getCardProducts()
{
    try {
        $products = ProductCard::all();

        $products = $products->map(function ($product) {
            if ($product->photo_product) {
                // Generate a full URL for the stored image
                $product->photo_url = url('storage/' . $product->photo_product);
            } else {
                $product->photo_url = null;
            }
            return $product;
        });

        return response()->json($products, 200);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
}
