<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasicProductsPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basic_products_prices', function (Blueprint $table) {
            $table->id();
            $table->string('name_of_products');
            $table->string('description')->nullable();
            $table->string('country')->nullable();
            $table->string('type')->nullable();
            $table->double('brutto')->nullable();
            $table->double('netto')->nullable();
            $table->string('photo_product')->nullable();

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
        Schema::dropIfExists('basic_products_prices');
    }
}