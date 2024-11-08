<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'product_id',
        'client_id',
        'quantity_sold',
        'price_at_sale',
    ];

    public function product()
{
    return $this->belongsTo(BasicProductsPrice::class);
}

}
