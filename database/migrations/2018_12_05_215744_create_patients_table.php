<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_sangre');
            $table->double('peso',6,2);
            $table->double('talla',5,2);
            $table->double('estatura',6,2);
            $table->text('alergias')->nullable();
            $table->text('medicamentos')->nullable();
            $table->text('enfermedades')->nullable();
            $table->string('fecha_naci');
            $table->enum('sexo',['masculino','femenino']);

            $table->integer('user_id')->unsigned();
            
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
