<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Consultation;

class CreateConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->increments('id');
            $table->double('peso',6,2);
            $table->double('talla',4,2);
            $table->double('estatura',6,2);
            $table->text('examen_fisico')->nullable();
            $table->text('examen_laboratorio')->nullable();
            $table->text('motivo_consulta')->nullable();
            $table->text('diagnostico');
            $table->string('pagado')->default(Consultation::NO_PAGADO);
            $table->string('fecha');

            $table->integer('appointment_id')->unsigned();

            $table->timestamps();

            $table->foreign('appointment_id')->references('id')->on('appointments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultations');
    }
}
