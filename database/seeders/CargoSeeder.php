<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cargo;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cargo::create(['name' => 'Ministro']);
        //Cargo::create(['name' => 'Ministra']);
        Cargo::create(['name' => 'Viceministro']);
        //Cargo::create(['name' => 'Viceministra']);
        Cargo::create(['name' => 'Director']);
        //Cargo::create(['name' => 'Directora']);
    }
}
