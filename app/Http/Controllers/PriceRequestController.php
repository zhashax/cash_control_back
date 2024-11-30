<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PriceRequest;
use Illuminate\Support\Facades\Log;

class PriceRequestController extends Controller
{
    public function store(Request $request)
    {
        Log::info('Received single price request data:', $request->all());
    
        try {
            $validated = $request->validate([
                'client_id' => 'required|integer|exists:users,id', // Ensure client ID exists
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'products' => 'required|array',
                'products.*.product_subcard_id' => 'required|integer|exists:product_sub_cards,id',
                'products.*.quantity' => 'required|integer|min:1',
                'products.*.price' => 'required|numeric|min:0',
            ]);
    
            foreach ($validated['products'] as $product) {
                PriceRequest::create([
                    'user_id' => $validated['client_id'], // Save client_id as user_id
                    'start_date' => $validated['start_date'],
                    'end_date' => $validated['end_date'],
                    'product_subcard_id' => $product['product_subcard_id'],
                    'amount' => $product['quantity'], // Map quantity to amount
                    'price' => $product['price'],
                ]);
            }
    
            return response()->json([
                'message' => 'Price request created successfully!',
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed for single price request:', ['errors' => $e->errors()]);
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error saving single price request:', ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Failed to save price request',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    

    public function bulkStore(Request $request)
    {
        Log::info('Received bulk price request data:', $request->all());
    
        try {
            $validated = $request->validate([
                'price_requests' => 'required|array',
                'price_requests.*.client_id' => 'required|integer|exists:users,id',
                'price_requests.*.start_date' => 'required|date',
                'price_requests.*.end_date' => 'required|date|after_or_equal:price_requests.*.start_date',
                'price_requests.*.products' => 'required|array',
                'price_requests.*.products.*.product_subcard_id' => 'required|integer|exists:product_sub_cards,id',
                'price_requests.*.products.*.quantity' => 'required|integer|min:1',
                'price_requests.*.products.*.price' => 'required|numeric|min:0',
            ]);
    
            Log::info('Validated bulk price request data:', $validated);
    
            // Process each price request
            foreach ($validated['price_requests'] as $priceRequest) {
                foreach ($priceRequest['products'] as $product) {
                    PriceRequest::create([
                        'user_id' => $priceRequest['client_id'],
                        'product_subcard_id' => $product['product_subcard_id'],
                        'amount' => $product['quantity'],
                        'price' => $product['price'],
                        'start_date' => $priceRequest['start_date'],
                        'end_date' => $priceRequest['end_date'],
                    ]);
                }
            }
    
            return response()->json([
                'message' => 'Bulk price requests saved successfully!',
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed for bulk price requests:', ['errors' => $e->errors()]);
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error saving bulk price requests:', ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Failed to save bulk price requests',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    
    
}
