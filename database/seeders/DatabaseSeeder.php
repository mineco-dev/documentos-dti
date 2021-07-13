<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            CargoSeeder::class,
            RoleSeeder::class,
        	DepartamentoSeeder::class,
            DependenciaSeeder::class,
            EntidadSeeder::class,
            EstadoDocumentoSeeder::class,
        	GeneroSeeder::class,
            SaludoSeeder::class,
            //TipoDocumentoSeeder::class,
        ]);
    }
}
