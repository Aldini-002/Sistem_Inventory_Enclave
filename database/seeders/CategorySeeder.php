<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Chair',
            'Table',
            'Decoration',
            'Shelf',
            'Other',
        ];

        foreach ($names as $i => $value) {
            Category::factory()->create([
                'name' => $value,
                'sku' => $i += 1
            ]);
        }
    }
}
