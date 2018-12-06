<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescriptionProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_products', function (Blueprint $table) {
            $table->increments('id');
            $table->text('indicacion');
            
            $table->integer('prescription_id')->unsigned();
            $table->integer('product_id')->unsigned();

            $table->timestamps();

            $table->foreign('prescription_id')->references('id')->on('prescriptions');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prescription_products');
    }
}
