<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         // склады общие 
        Schema::create('general_warehouses', function (Blueprint $table) {
            $table->id();
            $table->integer('product_card_id');
            $table->double('amount')->nullable();
            $table->string('unit_measurement')->nullable();
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
        Schema::dropIfExists('general_warehouses');
    }
}
