<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->string('id')->primary();

            $table->string('firstName');
            $table->string('lastName');
            $table->string('telephone');
            $table->string('street');
            $table->string('streetNumber');
            $table->string('zipcode');
            $table->string('city');
            $table->string('accountOwner');
            $table->string('iban');

            $table->string('remotePaymentDataId')->nullable();

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
        Schema::dropIfExists('customers');
    }
}
