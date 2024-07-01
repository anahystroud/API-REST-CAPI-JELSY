<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Contacto;
use App\Models\Telefono;
use App\Models\Email;
use App\Models\Direccion;

use Faker\Factory as Faker;

class ContactoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 5000) as $index) {

            $contacto = Contacto::create([
                'name' => $faker->name
            ]);

            for ($i=0; $i < rand( 1, 3 ) ; $i++) { 
                Telefono::create([
                    'contacto_id' => $contacto->id,
                    'telefono' => $faker->phoneNumber
                ]);
            }

            for ($i=0; $i < rand( 1, 2 ) ; $i++) { 
                Email::create([
                    'contacto_id' => $contacto->id,
                    'email' => $faker->safeEmail
                ]);
            }

            for ($i=0; $i < rand( 1, 2 ) ; $i++) {
                Direccion::create([
                    'contacto_id' => $contacto->id,
                    'direccion' => $faker->address
                ]);
            }
        }
    }
}