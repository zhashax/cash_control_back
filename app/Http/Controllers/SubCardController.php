<?php

namespace App\Http\Controllers;

use App\Models\ProductCard;
use App\Models\ProductSubCard;
use Illuminate\Http\Request;

class SubCardController extends Controller
{
    // Store a new ProductSubCard
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_card_id' => 'required|integer|exists:product_cards,id',
            'client_id' => 'nullable|integer|exists:clients,id', // If clients table exists
            'quantity_sold' => 'required|numeric|min:0',
            'price_at_sale' => 'required|numeric|min:0',
        ]);

        $subCard = ProductSubCard::create($validated);

        return response()->json([
            'message' => 'SubCard created successfully',
            'data' => $subCard,
        ], 201);
    }

    // Fetch all subcards for a specific product card
    public function fetchByProductCard($productCardId)
    {
        $subCards = ProductSubCard::where('product_card_id', $productCardId)->get();

        return response()->json([
            'data' => $subCards,
        ], 200);
    }
}
