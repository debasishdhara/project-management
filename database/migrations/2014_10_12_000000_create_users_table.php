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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->boolean('user_status')->default(false);
            $table->string('user_image')->nullable();
            $table->string('frist_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('user_phone')->nullable();
            $table->string('user_address_line_1')->nullable();
            $table->string('user_address_line_2')->nullable();
            $table->string('user_address_line_3')->nullable();
            $table->string('user_country')->nullable();
            $table->string('user_state')->nullable();
            $table->string('user_city')->nullable();
            $table->string('user_pincode')->nullable();
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
