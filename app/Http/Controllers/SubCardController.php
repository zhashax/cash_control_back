<?php

namespace App\Http\Controllers;

use App\Models\ProductCard;
use App\Models\ProductSubCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class SubCardController extends Controller
{
    // Store a new ProductSubCard
    public function store(Request $request)
    {
        Log::info($request->all());
        $validated = $request->validate([
            'product_card_id' => 'required|exists:product_cards,id',
            'quantity_sold' => 'required|numeric',
            'price_at_sale' => 'required|integer',
        ]);

        $subCard = ProductSubCard::create($validated);

        return response()->json([
            'message' => 'Подкарточка успешно создана!',
            'data' => $subCard,
        ], 201);
    }

    public function getSubCards()
{
    Log::info('Fetching all product subcards.');

    try {
        // Eager load product_card relation
        $subcards = ProductSubCard::with('productCard')->get();

        return response()->json($subcards, 200);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
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
