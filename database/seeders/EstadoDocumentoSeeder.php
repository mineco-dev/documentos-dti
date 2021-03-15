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
        EstadoDocumento::create(['name' => 'Pendiente de adjuntar documento']);
        EstadoDocumento::create(['name' => 'Archivado']);
    }
}
