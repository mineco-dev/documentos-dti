<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departamento;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departamento::create([
        	'name' => 'Director'
        ]);
        Departamento::create([
        	'name' => 'Secretaria'
        ]);
        Departamento::create([
        	'name' => 'Redes'
        ]);
        Departamento::create([
        	'name' => 'Infraestructura'
        ]);
        Departamento::create([
        	'name' => 'Soporte técnico'
        ]);
        Departamento::create([
        	'name' => 'Desarrollo'
        ]);
    }
}
