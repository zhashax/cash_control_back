<?php
// app/Services/BasicProductService.php

namespace App\Services;

use App\Models\BasicProduct;
use App\Models\BasicProductsPrice;
use App\Models\Sales;
use Illuminate\Support\Facades\DB;

class BasicProductService
{
    // Create a new product
    public function createProduct(array $data): BasicProductsPrice
    {
        return BasicProductsPrice::create([
            'name_of_products' => $data['name_of_products'],
            'description' => $data['description'] ?? null,
            'country' => $data['country'] ?? null,
            'type' => $data['type'] ?? null,
            'brutto' => $data['brutto'] ?? null,
            'netto' => $data['netto'] ?? null,
            'photo_product' => $data['photo_product'] ?? null,
        ]);
    }

    // Create a new sales entry linked to a product
    public function createSale(array $data): Sales
    {
        return Sales::create([
            'product_id' => $data['product_id'],
            'client_id' => $data['client_id'] ?? null,
            'quantity_sold' => $data['quantity_sold'],
            'price_at_sale' => $data['price_at_sale'],
        ]);
    }
}
