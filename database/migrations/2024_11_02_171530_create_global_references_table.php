<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlobalReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_references', function (Blueprint $table) {
            $table->id();
            $table->string('name_of_products');
            $table->string('description')->nullable();
            $table->double('quantity')->nullable();
            $table->string('country')->nullable();
            $table->string('type')->nullable();
            $table->double('brutto')->nullable();
            $table->double('netto')->nullable();
            $table->integer('price')->nullable();
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
        Schema::dropIfExists('global_references');
    }
}
