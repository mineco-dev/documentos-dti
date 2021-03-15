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
        TipoDocumento::create(['name' => 'Oficio', 'prefix' => 'OF']);
        TipoDocumento::create(['name' => 'Dictámen']);
        TipoDocumento::create(['name' => 'Memorándum', 'prefix' => 'ME']);
        TipoDocumento::create(['name' => 'Providencia']);
    }
}
