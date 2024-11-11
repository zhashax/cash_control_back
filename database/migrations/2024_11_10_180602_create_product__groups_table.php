<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('product_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_warehouse_id')->constrained('admin_warehouses')->onDelete('cascade');
            $table->foreignId('basic_product_price_id')->constrained('basic_products_prices')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_groups');
    }
};
