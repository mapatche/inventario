<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $departamentos = ['Contabilidad', 'Sistemas', 'Legal', 'Ventas', 'Compras', 'RRHH', 'Piso', 'Seguridad'];

        foreach ($departamentos as $depto) {
            Department::query()->updateOrCreate(
                ['name' => $depto],
                []
            );
        }

        $this->call([
            EmployeeSeeder::class,
            TypeSeeder::class,
            BrandSeeder::class,
            SectionSeeder::class,
            ItemSeeder::class,
            // LoanSeeder::class,
            PrivilegesSeeder::class,
        ]);

    }
}
