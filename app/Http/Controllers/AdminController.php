<?php

namespace App\Http\Controllers;

use App\Models\BasicProductsPrice;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\PriceRequest;
use App\Models\Product_Group;
use App\Models\AdminWarehouse;
use Illuminate\Support\Facades\Log;

use App\Models\Product;
use App\Models\ProductCard;
use App\Models\ProductSubCard;

class AdminController extends Controller
{
    public function index(){

    }

    // public function create_user(Request $request){
    //     $user create([]);

    // }

    public function store_receiving_products(Request $request)
{
    Log::info('Request Data:', $request->all());

    // Validate the request
    $validated = $request->validate([
        'organization_id' => 'nullable|integer|exists:users,id',
        'product_card_id' => 'required|integer|exists:product_cards,id',
        'unit_measurement' => 'nullable|string',
        'quantity' => 'nullable|numeric|min:0',
        'price' => 'nullable|numeric|min:0',
        'total_sum' => 'nullable|numeric|min:0',
        'date' => 'nullable|date',
    ]);

    // Save the data to the database
    $adminWarehouse = AdminWarehouse::create($validated);

    return response()->json([
        'message' => 'Product received successfully',
        'data' => $adminWarehouse,
    ], 201);
}


    public function create_product(Request $request){
        return ProductCard::create($request->query->all());
    }



    public function storeProduct(Request $request)
{
    $request->validate([
        'name_of_products' => 'required|string',
        'type' => 'required|string',
        'photo_product' => 'nullable|image|mimes:jpeg,png,jpg,gif',
    ]);

    $data = $request->all();
    if ($request->hasFile('photo_product')) {
        // сохр в папку 'public/products/photos' 
        $imagePath = $request->file('photo_product')->store('products/photos', 'public');
        $data['photo_product'] = $imagePath;
    }

    ProductCard::create($data);

    return response()->json(['success' => 'Product created successfully.'], 201);
}


public function update(Request $request, ProductCard $product)
{
    $request->validate([
        'name_of_products' => 'required|string',
        'type' => 'required|string',
        'photo_product' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->all();

    // Check if a new file is uploaded
    if ($request->hasFile('photo_product')) {
        // Store the new image
        $imagePath = $request->file('photo_product')->store('products/photos', 'public');
        $data['photo_product'] = $imagePath;

        // Optionally delete the old photo file if it exists
        if ($product->photo_product && Storage::disk('public')->exists($product->photo_product)) {
            Storage::disk('public')->delete($product->photo_product);
        }
    }

    $product->update($data);

    return response()->json(['success' => 'Product updated successfully.']);
}


public function sellProduct(Request $request, $productId)
{
    $request->validate([
        'quantity' => 'required|numeric|min:0.01',
        'price' => 'required|integer|min:1',
    ]);

    $product = ProductSubCard::findOrFail($productId);

    if ($product->quantity < $request->quantity) {
        return response()->json(['error' => 'Not enough stock available'], 400);
    }

    // Reduce the product quantity
    $product->quantity -= $request->quantity;
    $product->save();

    // Create a new sale record
    $sale = new ProductSubCard();
    $sale->product_id = $product->id;
    $sale->quantity_sold = $request->quantity;
    $sale->price_at_sale = $request->price;
    $sale->save();

    return response()->json(['message' => 'Product sold successfully', 'sale' => $sale]);
}

// Ценовое предложение

// Create a new offer request
public function createOfferRequest(Request $request)
{
    $validator = Validator::make($request->all(), [
        'user_id' => 'required|exists:users,id',
        'product_id' => 'required|exists:basic_products_prices,id',
        'unit_measurement' => 'required|string',
        'amount' => 'required|integer',
        'price' => 'required|numeric',
        'choice_status' => 'nullable|string',
        'address_id' => 'nullable|integer'
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $priceRequest = PriceRequest::create($request->all());

    return response()->json([
        'message' => 'Offer request created successfully',
        'data' => $priceRequest
    ], 201);
}

// Get all offer requests
public function getOfferRequests()
{
    $requests = PriceRequest::with(['user', 'product'])->get();
    return response()->json($requests, 200);
}

// Get a specific offer request
public function getOfferRequest($id)
{
    $request = PriceRequest::with(['user', 'product'])->find($id);

    if (!$request) {
        return response()->json(['message' => 'Request not found'], 404);
    }

    return response()->json($request, 200);
}
// Ценовое предложение end

// ТМЗ
public function addProductToWarehouse(Request $request)
    {
        $validated = $request->validate([
            'admin_warehouse_id' => 'required|exists:admin_warehouses,id',
            'basic_product_price_id' => 'required|exists:basic_products_prices,id'
        ]);

        $productGroup = Product_Group::create($validated);

        return response()->json([
            'message' => 'Product linked to warehouse successfully',
            'data' => $productGroup
        ], 201);
    }

        // Достать из склада определенный товар
        public function getProductsByWarehouse($warehouseId)
        {
            $products = Product_Group::where('admin_warehouse_id', $warehouseId)
                ->join('basic_products_prices', 'product_groups.basic_product_price_id', '=', 'basic_products_prices.id')
                ->select('basic_products_prices.*')
                ->get();
    
            return response()->json($products, 200);
        }
    
    // TMZ

// Админ добавляет на свой склад карточку товара
    public function createWarehouse(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'nullable|exists:users,id',
            'name_of_products' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unit_measurement' => 'nullable|string',
            'quantity' => 'nullable|numeric',
            'type' => 'nullable|string',
            'price' => 'nullable|integer',
        ]);

        $warehouse = AdminWarehouse::create($validated);

        return response()->json(['message' => 'Warehouse created successfully', 'data' => $warehouse], 201);
    }

    // Get all warehouses
    public function getAllWarehouses()
    {
        $warehouses = AdminWarehouse::all();
        return response()->json($warehouses, 200);
    }

// Админ добавляет на свой склад карточку товара


   


}
