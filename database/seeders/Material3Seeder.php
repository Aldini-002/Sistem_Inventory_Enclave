<?php

namespace Database\Seeders;

use App\Models\Material3;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Material3Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Default',
            'Goat leather',
            'Cow leather',
            'Synthetic leather',
            'Cotton',
            // 'Acrylic',
            // 'Alumunium',
        ];

        foreach ($names as $i => $value) {
            Material3::factory()->create([
                'name' => $value,
                'sku' => $i
            ]);
        }
    }
}
