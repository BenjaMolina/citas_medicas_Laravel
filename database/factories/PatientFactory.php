<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Patient::class, function (Faker $faker) {

    return [
        'tipo_sangre' =>$faker->countryCode,
        'peso' => $faker->randomFloat(2, 10, 100),
        'talla' => $faker->randomFloat(2,10,100),
        'estatura' => $faker->numberBetween(150,230),
        'alergias' => $faker->text,
        'medicamentos' => $faker->text,
        'enfermedades' => $faker->text,
        'fecha_naci' => $faker->date('Y-m-d'),
        'sexo' => $faker->randomElement(['masculino','femenino']),
        'user_id' => null,
    ];
});
