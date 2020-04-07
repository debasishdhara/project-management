<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licences', function (Blueprint $table) {
            $table->id();
            $table->string('licence_name');
            $table->string('licence_key')->unique();
            $table->longText('licence_description')->nullable();
            $table->double('licence_discount', 8, 2)->default(0.00);
            $table->double('licence_amount', 8, 2)->default(0.00);
            $table->double('licence_tax', 8, 2)->default(0.00);
            $table->double('licence_taxableamount', 8, 2)->default(0.00);
            $table->double('licence_net_amount', 8, 2)->default(0.00);
            $table->bigInteger('licence_validity')->default(1);
            $table->date('licence_from')->nullable();
            $table->date('licence_to')->nullable();
            $table->bigInteger('licence_user_limit')->default(2);
            $table->string('licence_mac')->nullable();
            $table->boolean('licence_status')->default(false);
            $table->boolean('licence_pre_status')->default(false);
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
        Schema::dropIfExists('licences');
    }
}
