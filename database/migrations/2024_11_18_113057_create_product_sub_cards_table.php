<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSubCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sub_cards', function (Blueprint $table) {
            $table->id();
            $table->integer('product_card_id'); // Reference to products table
            $table->integer('client_id')->nullable(); // Reference to the client if applicable
            $table->double('quantity_sold');
            $table->integer('price_at_sale'); // Price per unit at the time of sale
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
        Schema::dropIfExists('product_sub_cards');
    }
}
