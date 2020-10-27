<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
//use Faker\Generator as Faker;
use App\Laravue\Models\Material;


class MaterialesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i=0; $i<=100; $i++):
            $faker = \Faker\Factory::create();
            $orden_fake = Material::create([
                'descripcion' => $faker->sentence,
                'stock' => $faker->numberBetween($min = 1, $max = 1000),
                'proveedor' => $faker->company,
                'contactoproveedor' => $faker->tollFreePhoneNumber,
                'observacion' => $faker->text($maxNbChars = 150),
                'unidad' => null,
            ]);
        endfor;
    }
}
