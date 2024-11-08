<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('surname')->nullable();
            $table->string('whatsapp_number');
            //admins address and cash amount
            $table->string('summary')->nullable();
            $table->string('address')->nullable();
            //admins address end

            $table->string('role')->default('client');
            $table->string('password');
            $table->string('photo')->nullable(); // Add photo field

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
