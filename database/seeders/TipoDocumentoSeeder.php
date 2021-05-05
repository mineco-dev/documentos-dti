<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoDocumento;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoDocumento::create([
            'name' => 'Oficios',
            'prefix' => 'DTI-OF',
            'directory' => 'oficios',
            'correlativo' => 1,
            'anio' => 2021,
        ]);
        TipoDocumento::create([
            'name' => 'Dictámenes Técnicos',
            'prefix' => 'DTI',
            'directory' => 'dictamenes',
            'correlativo' => 1,
            'anio' => 2021,
        ]);
        TipoDocumento::create([
            'name' => 'Memorandos',
            'prefix' => 'DTI-ME',
            'directory' => 'memorandums',
            'correlativo' => 1,
            'anio' => 2021,
        ]);
        TipoDocumento::create([
            'name' => 'Providencia',
            'prefix' => 'DTI',
            'directory' => 'providencias',
            'correlativo' => 1,
            'anio' => 2021,
        ]);
    }
}
