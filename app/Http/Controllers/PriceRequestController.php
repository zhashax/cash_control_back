<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PriceRequest;
use Illuminate\Support\Facades\Log;

class PriceRequestController extends Controller
{
    public function store(Request $request)
{
    // Log the incoming request for debugging
    Log::info('Request Data:', $request->all());

    // Validate the incoming data
    $validated = $request->validate([
        'choice_status' => 'nullable|string',
        'user_id' => 'required|integer|exists:users,id',
        'address_id' => 'nullable|integer|exists:addresses,id',
        'products' => 'required|array',
        'products.*.product_id' => 'required|integer|exists:product_cards,id',
        'products.*.amount' => 'required|integer|min:1',
        'products.*.price' => 'required|numeric|min:0',
    ]);

    // Create price requests for each product
    foreach ($validated['products'] as $product) {
        PriceRequest::create([
            'choice_status' => $validated['choice_status'] ?? 'Pending', // Default to 'Pending'
            'user_id' => $validated['user_id'],
            'address_id' => $validated['address_id'],
            'product_card_id' => $product['product_id'],
            'amount' => $product['amount'],
            'price' => $product['price'],
        ]);
    }

    // Return success response
    return response()->json([
        'message' => 'Price requests created successfully',
    ], 201);
}


    
}
