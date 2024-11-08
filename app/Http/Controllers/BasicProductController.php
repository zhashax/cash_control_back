<?php

// app/Http/Controllers/BasicProductController.php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBasicProductRequest;
use App\Http\Requests\CreateSalesRequest;
use App\Services\BasicProductService;
use Illuminate\Http\JsonResponse;

class BasicProductController extends Controller
{
    protected $basicProductService;

    public function __construct(BasicProductService $basicProductService)
    {
        $this->basicProductService = $basicProductService;
    }

    // Create a new product (Карточка товара)
    public function store(CreateBasicProductRequest $request): JsonResponse
    {
        $product = $this->basicProductService->createProduct($request->validated());

        return response()->json($product, 201);
    }

    // Create a new sub-product (Подкарточка)
    public function storeSales(CreateSalesRequest $request): JsonResponse
    {
        $sale = $this->basicProductService->createSale($request->validated());

        return response()->json($sale, 201);
    }
}
