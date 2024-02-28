<?php

namespace Database\Seeders;

use App\Models\Material4;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Material4Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Default',
            'Water hyacinth',
            'Mendong',
            'Seagrass',
            'Pandan',
            // 'Rafia',
            // 'Banana bark',
        ];

        foreach ($names as $i => $value) {
            Material4::factory()->create([
                'name' => $value,
                'sku' => $i
            ]);
        }
    }
}
