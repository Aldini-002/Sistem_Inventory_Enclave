<?php

namespace Database\Seeders;

use App\Models\Material2;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Material2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Default',
            'Teak wood',
            'Soar wood',
            'Mahogany wood',
            'Mindy wood',
            'Dutch teak',
            'Acacia wood',
            'Rose wood',
        ];

        foreach ($names as $i => $value) {
            Material2::factory()->create([
                'name' => $value,
                'sku' => $i
            ]);
        }
    }
}
