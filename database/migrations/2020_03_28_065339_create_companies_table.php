<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_email');
            $table->string('company_phone')->nullable();
            $table->string('company_address_line_1');
            $table->string('company_address_line_2')->nullable();
            $table->string('company_address_line_3')->nullable();
            $table->string('company_state')->nullable();
            $table->string('company_country')->nullable();
            $table->string('company_pin')->nullable();
            $table->string('company_fax')->nullable();
            $table->string('company_gstin')->nullable();
            $table->string('company_vat')->nullable();
            $table->string('company_alise')->nullable();
            $table->bigInteger('company_validity')->default(1);
            $table->date('company_from')->nullable();
            $table->date('company_to')->nullable();
            $table->boolean('company_status')->default(false);
            $table->string('company_logo')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
