<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sales;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'name_of_products',
        'description',
        'unit_measurement',
        'quantity',
        'country',
        
        'type',
        'photo_product',
        'price',
          
    ];

    public function sales()
{
    return $this->hasMany(Sales::class);
}

}
