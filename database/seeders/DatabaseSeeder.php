<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $departamentos = ['Contabilidad', 'Sistemas', 'Legal', 'Ventas', 'Compras', 'RRHH', 'Piso', 'Seguridad'];
        $sections = ['Interno', 'Externo'];

        foreach ($departamentos as $depto) {
            Department::query()->updateOrCreate(
                ['name' => $depto],
                []
            );
        }
        foreach ($sections as $section) {
            Section::query()->updateOrCreate(
                ['name' => $section],
                []
            );
        }

        $this->call([
            // EmployeeSeeder::class,
            // TypeSeeder::class,
            // BrandSeeder::class,
            // SectionSeeder::class,
            // ItemSeeder::class,
            // LoanSeeder::class,
            PrivilegesSeeder::class,
        ]);

    }
}
