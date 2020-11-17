<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'tipo_usuario' => $faker->randomElement($array = array ('administrador','alumno', 'tutor','asesor','director','subdirector')),
        'curp' =>$faker->unique()->numberBetween($min =10000, $max =80000),
        'rfc' => $faker->numberBetween($min =100, $max = 900),
        'nombre' => $faker->name,
        'ap_paterno'=>$faker->firstNameFemale,
        'ap_materno'=>$faker->lastName,
        'genero'=>$faker->randomElement($array = array ('masculino','femenino')) ,
        'fecha_nacimiento'=>$faker->date($format = 'Y-m-d', $max = 'now') ,
        'code_postal'=>$faker->postcode(),
        'localidad'=>$faker->numberBetween($min = 126537, $max = 126543),
        'telefono'=>$faker->unique()->tollFreePhoneNumber,
        'email' => $faker->unique()->safeEmail,
        'active'=>$faker->numberBetween($min = 1, $max = 3),
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'photo'=>$faker->imageUrl($width = 640, $height = 480),
        'remember_token' => Str::random(10),
    ];
});
