<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // накладная, заявка
        Schema::create('documents_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->integer('product_card_id');
            $table->integer('price')->nullable();
            $table->integer('unit_measurement_id');
            $table->integer('amount')->nullable();
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
        Schema::dropIfExists('general_reports');
    }
}
