<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EstadoDocumento;

class EstadoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadoDocumento::create(['name' => 'Pendiente de adjuntar']);
        EstadoDocumento::create(['name' => 'Documento cargado']);
        EstadoDocumento::create(['name' => 'Archivado']);
    }
}
