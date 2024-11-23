<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminWarehouse extends Model
{
    use HasFactory;
    protected $fillable = [
        'organization_id',
        'product_card_id',
        'unit_measurement',// ед измерение
        'quantity', // количества
        'price',//цена
        'total_sum',//итог
           
    ];
}
