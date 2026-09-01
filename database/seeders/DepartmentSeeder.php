<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departamentos = ['Contabilidad', 'Sistemas', 'Legal', 'Ventas', 'Compras', 'RRHH', 'Piso', 'Seguridad'];

        foreach ($departamentos as $depto) {
            Department::query()->updateOrCreate(
                ['name' => $depto],
                []
            );
        }

    }
}
