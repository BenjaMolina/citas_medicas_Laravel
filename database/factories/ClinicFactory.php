<?php

use Faker\Generator as Faker;

$factory->define(App\Clinic::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'direccion' =>$faker->address,
        'giro' => $faker->word,
        'telefono' => $faker->phoneNumber,
        'correo' => $faker->unique()->safeEmail,
        'descripcion' => $faker->text
    ];
});
