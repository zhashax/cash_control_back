<?php

// app/Http/Controllers/BasicProductController.php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBasicProductRequest;
use App\Http\Requests\CreateSalesRequest;
use App\Services\BasicProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\BasicProductsPrice;

class BasicProductController extends Controller
{
    protected $basicProductService;

    public function __construct(BasicProductService $basicProductService)
    {
        $this->basicProductService = $basicProductService;
    }

    // Create a new product (Карточка товара)
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

    $product = BasicProductsPrice::create($data);

    return response()->json($product, 201);
}
    // Create a new sub-product (Подкарточка)
    public function storeSales(CreateSalesRequest $request): JsonResponse
    {
        $sale = $this->basicProductService->createSale($request->validated());

        return response()->json($sale, 201);
    }


    public function getAllProducts()
    {
        $products = BasicProductsPrice::all();
        return response()->json($products, 200);
    }
}
