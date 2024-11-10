<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBProductPRequestGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Группа,заявка, накладная, поступление ценового предложения
        Schema::create('b_product__p_request__groups', function (Blueprint $table) {
            $table->id();
            $table->integer('basic_product_id');
            $table->integer('price_request_id');
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
        Schema::dropIfExists('b_product__p_request__groups');
    }
}
