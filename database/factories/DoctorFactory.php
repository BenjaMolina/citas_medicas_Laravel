<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Doctor::class, function (Faker $faker) {
    return [
        'cedula' => $faker->randomNumber,
        'especialidad' =>$faker->paragraph(1),
        'area_id' => $faker->numberBetween(1,2),
        'user_id' => null,
    ];
});
