<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('admin_warehouses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('name_of_products');
            $table->string('description')->nullable();
            $table->string('unit_measurement')->nullable();
            $table->double('quantity')->nullable(); // Total stock remaining
            $table->string('type')->nullable();
            $table->integer('price')->nullable(); // Default price if needed
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_warehouses');
    }
};
