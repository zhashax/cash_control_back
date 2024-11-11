<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BasicProductsPrice;

class PriceRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'choice_status',
        'user_id',
        'address_id',
        'product_id',
        'unit_measurement',
        'amount',
        'price'
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
