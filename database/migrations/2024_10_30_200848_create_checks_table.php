<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // чеки кассы
        Schema::create('checks', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->integer('admin_cash_id');
            $table->integer('user_id');
            $table->integer('cashbox_id');
            $table->integer('summary_cash');
            $table->date('date_of_check');
            $table->string('photo_of_check')->nullable();
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
        Schema::dropIfExists('checks');
    }
}
