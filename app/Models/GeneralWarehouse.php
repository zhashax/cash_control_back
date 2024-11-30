<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralWarehouse extends Model
{
    use HasFactory;
    protected $table = 'general_warehouses';

    protected $fillable =
    [
        'storager_id', 
        'product_subcard_id',//subcard
        'amount',
        'unit_measurement',
        'date',

    ];
}
