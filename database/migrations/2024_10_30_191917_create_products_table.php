<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->nullable();
            $table->string('name_of_products');
            $table->string('description')->nullable();
            $table->string('unit_measurement')->nullable();
            $table->double('quantity')->nullable(); // This represents total remaining stock
            $table->string('type')->nullable();
            $table->string('photo_product')->nullable();
            $table->integer('price')->nullable(); // Default price if needed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
