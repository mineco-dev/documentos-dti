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
            'prefix' => 'OF',
            'directory' => 'oficios'
        ]);
        TipoDocumento::create([
            'name' => 'Dictámenes Técnicos',
            'directory' => 'dictamenes'
        ]);
        TipoDocumento::create([
            'name' => 'Memorandos',
            'prefix' => 'ME',
            'directory' => 'memorandos'
        ]);
        TipoDocumento::create([
            'name' => 'Providencia',
            'directory' => 'providencias'
        ]);
    }
}
