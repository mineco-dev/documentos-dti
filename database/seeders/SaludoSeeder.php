<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Saludo;

class SaludoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Saludo::create(['name' => 'Licenciado']);
        Saludo::create(['name' => 'Licenciada']);
        Saludo::create(['name' => 'Ingeniero']);
        Saludo::create(['name' => 'Ingeniera']);
        Saludo::create(['name' => 'Arquitecto']);
        Saludo::create(['name' => 'Arquitecta']);
    }
}
