<?php

use Illuminate\Database\Seeder;



use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
//use Faker\Generator as Faker;
use App\Laravue\Models\Activities;


class ActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tablas = ["activities", "clientes", "codigos", "conexion","configuracion","facturacion", "items", "login", "planpago", "usuarios", "medidores", "tmedidores", "mateirales", "mediciones", "movimientos", "ordentrabajo"];
        $tipos = ["alta", "baja", "modificacion", "sistema","lectura","otro"];
        $estados = ["aprobada", "sin aprobar", "sin leer", "revertida"];
        for($i=0; $i<=50; $i++):
            $faker = \Faker\Factory::create();
            $orden_fake = Activities::create([
                'tipo_log' =>  $tipos[$faker->numberBetween($min = 0, count($tipos) - 1)],
                'created_by' => $faker->numberBetween($min = 1, $max = 50),
                'tabla_modificada' => $tablas[$faker->numberBetween($min = 0, count($tablas) -1 )],
                'id_row_modificada' => $faker->numberBetween($min = 1, $max = 2000),
                'valores_anteriores' => $faker->text($maxNbChars = 150),
                'estado' => $estados[$faker->numberBetween($min = 0, count($estados) -1 )],
            ]);
        endfor;
    }
}
