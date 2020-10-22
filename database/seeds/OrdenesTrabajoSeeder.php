<?php

use Illuminate\Database\Seeder;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
//use Faker\Generator as Faker;
use App\Laravue\Models\OrdenTrabajo;




class OrdenesTrabajoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i=0; $i<=500; $i++):
            $faker = \Faker\Factory::create();
            $orden_fake = OrdenTrabajo::create([
                'description' => $faker->sentence,
                'idcliente' => $faker->numberBetween($min = 1, $max = 2000),
                'direccion' => $faker->address,
                'idconexion' => $faker->numberBetween($min = 1, $max = 2000),
                'idtecnico' => $faker->numberBetween($min = 1, $max = 20),
                'startdate' => $faker->date($format = 'Y-m-d H:i:s', $max = 'now'),
                'enddate' => $faker->date($format = 'Y-m-d H:i:s', $max = 'now'),
                'porcent' => $faker->numberBetween($min = 1, $max = 100),
                'color' => $faker->safeColorName,
                'created_by' => $faker->numberBetween($min = 1, $max = 25),
                'estado' => $faker->numberBetween($min = 1, $max = 4),
                'newconexion' => null,
                'observacion' => $faker->text($maxNbChars = 150),
            ]);
        endfor;

    }
}
