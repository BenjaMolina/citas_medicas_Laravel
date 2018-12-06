<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Appointment;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('asunto');
            $table->string('hora');
            $table->string('fecha');
            $table->string('estatus')->default(Appointment::NO_ATENDIDO);
            $table->string('observaciones')->nullable();

            //Atributos/Relacion Polimorfica
            $table->integer('appointmentable_id')->unsigned();
            $table->string('appointmentable_type');

            $table->integer('patient_id')->unsigned();
            $table->integer('doctor_id')->unsigned();

            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('doctor_id')->references('id')->on('doctors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
