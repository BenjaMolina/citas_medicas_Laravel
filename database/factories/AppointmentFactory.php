<?php

use App\Doctor;
use App\Patient;
use App\Appointment;
use Faker\Generator as Faker;
use App\Employee;

$factory->define(App\Appointment::class, function (Faker $faker) {
    $patient = Patient::all()->random();
    $doctor = Doctor::all()->random();
    $empleado = Employee::all()->random();
    
    $typo = [
        [$doctor->id,'App\Doctor'],
        [$patient->id,'App\Patient'],
        [$empleado->id,'App\Employee']
    ];

    $select = $faker->randomElement($typo);
    
    return [
        'asunto' => $faker->paragraph(1),
        'hora' => $faker->time('H:i:s'),
        'fecha' => $faker->date('Y-m-d'),
        'estatus' => $faker->randomElement([Appointment::ATENDIDO,Appointment::NO_ATENDIDO]),
        'observaciones' => $faker->paragraph(1),
        'patient_id' => $patient->id, 
        'doctor_id' => $doctor->id,
        'appointmentable_id' => $select[0],
        'appointmentable_type' => $select[1],
    ];
});
