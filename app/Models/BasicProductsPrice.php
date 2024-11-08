<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasicProductsPrice extends Model
{
    use HasFactory;
    protected $table = 'basic_products_prices';


    protected $fillable = [
        'name_of_products',
        'description',
        'country',
        'type',
        'brutto',
        'netto',
        'photo_product',
          
    ];
}
