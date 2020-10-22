<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OrdenTrabajo;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(OrdenTrabajo::class, function (Faker $faker) {
    return [
        //'OrdenTrabajo_Id' => 
        'OrdenTrabajo_Tarea' => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'OrdenTrabajo_Cliente' => $faker->name,
        'OrdenTrabajo_Direccion' => $faker->address,
        'OrdenTrabajo_NConexion' => $faker->numberBetween(1,1000),
        'OrdenTrabajo_Tecnico' => $faker->name,
        'OrdenTrabajo_FechaInicio' => $faker->dateTime($max = 'now', $timezone = null),
        'OrdenTrabajo_FechaFin' => $faker->dateTime($max = 'now', $timezone = null),
        'OrdenTrabajo_Porcentaje' => $faker->numberBetween(1,100),
        'OrdenTrabajo_Color' => $faker->safeColorName,
        'OrdenTrabajo_CodigoMaterial1' => $faker->numberBetween(1,100),
        'OrdenTrabajo_CodigoMaterial2' => $faker->numberBetween(1,100),
        'OrdenTrabajo_CodigoMaterial3' => $faker->numberBetween(1,100),
        'OrdenTrabajo_CodigoMaterial4' => null,
        'OrdenTrabajo_CodigoMaterial5' => null,
        'OrdenTrabajo_CantidadMaterial1' => $faker->numberBetween(1,100),
        'OrdenTrabajo_CantidadMaterial2' => $faker->numberBetween(1,100),
        'OrdenTrabajo_CantidadMaterial3' => $faker->numberBetween(1,100),
        'OrdenTrabajo_CantidadMaterial4' => null,
        'OrdenTrabajo_CantidadMaterial5' => null,
        'OrdenTrabajo_Creador' => $faker->$faker->numberBetween(1,10),
        'OrdenTrabajo_Estado' => "en proceso",
        'OrdenTrabajo_NewConexion' => null,
        'OrdenTrabajo_Observacion' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'OrdenTrabajo_Habilitacion' => 1,
        'OrdenTrabajo_Borrado' => 0,
    ];
});