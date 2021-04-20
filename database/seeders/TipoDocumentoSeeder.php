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
            'name' => 'Oficio',
            'prefix' => 'OF',
            'directory' => 'oficios'
        ]);
        TipoDocumento::create([
            'name' => 'Dictámen Técnico',
            'directory' => 'dictamenes'
        ]);
        TipoDocumento::create([
            'name' => 'Memorándum',
            'prefix' => 'ME',
            'directory' => 'memorandums'
        ]);
        TipoDocumento::create([
            'name' => 'Providencia',
            'directory' => 'providencias'
        ]);
    }
}
