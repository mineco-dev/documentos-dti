<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Entidad;

class EntidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Entidad::create(['name' => 'Ministerio de Economía']);
    }
}
