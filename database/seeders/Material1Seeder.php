<?php

namespace Database\Seeders;

use App\Models\Material1;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Material1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Default',
            'Wood',
            'Iron',
            'Plywood',
            'Cardboard',
            // 'Copper',
            // 'Leather',
            // 'Natural',
            // 'Rattan',
            // 'Bamboo',
        ];

        foreach ($names as $i => $value) {
            Material1::factory()->create([
                'name' => $value,
                'sku' => $i
            ]);
        }
    }
}
