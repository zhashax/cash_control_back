<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminWarehouse extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'name_of_products',
        'description',
        'unit_measurement',
        'quantity',
        'type',
        'price'
    ];
}
