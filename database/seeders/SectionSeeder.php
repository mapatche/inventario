<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = ['Interno', 'Externo'];
        foreach ($sections as $section) {
            Section::query()->updateOrCreate(
                ['name' => $section],
                []
            );
        }
    }
}
