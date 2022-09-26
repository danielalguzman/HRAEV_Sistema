<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::factory()->count(10)->create(
            new Sequence(
                ['name' => 'Planeación'],
                ['name' => 'Gestión'],
                ['name' => 'Recursos Humanos'],
                ['name' => 'Equipos Físicos'],
                ['name' => 'Centros de Datos'],
                ['name' => 'Redes y Telecomunicaciones'],
                ['name' => 'Equipo de Computo'],
                ['name' => 'Tecnología Móvil'],
                ['name' => 'Sistemas Aplicaciones y Servicios'],
                ['name' => 'Bases de Datos'],
                )
        );
    }
}
