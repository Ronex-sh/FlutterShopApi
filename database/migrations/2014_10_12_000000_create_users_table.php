<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->String('last_name');
            $table->string('email')->unique();
            $table->boolean('email_verified')->default(false);
            $table->string('mobile')->nullable();
            $table->boolean('mobile_verified')->default(false);
            $table->string('password');
            // $table->string('email_verified_at');

            $table->bigInteger('shipping_address')->nullable();
            $table->bigInteger('billing_address')->nullable();
            
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
