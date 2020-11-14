<?php

use Illuminate\Database\Seeder;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
//use Faker\Generator as Faker;
use App\Laravue\Models\OrdenTrabajoMaterial;



class OrdenTrabajoMaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i=0; $i<=2; $i++):
            $faker = \Faker\Factory::create();
            $orden_fake = OrdenTrabajoMaterial::create([
                //'id' => $faker->sentence,
                'ordentrabajo_id' => $faker->numberBetween($min = 1, $max = 50),
                'material_id' => $faker->numberBetween($min = 1, $max = 50),
                'cantidad' => $faker->numberBetween($min = 1, $max = 2000),
                'created_by' => $faker->numberBetween($min = 1, $max = 6),
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ]);
        endfor;
    }
}
