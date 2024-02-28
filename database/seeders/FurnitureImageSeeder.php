<?php

namespace Database\Seeders;

use App\Models\FurnitureImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FurnitureImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 44; $i++) {
            $image_name = 'factory' . $i . '.png';
            FurnitureImage::factory()->create([
                'furniture_id' => $i,
                'name' => $image_name,
                'url' => asset('img/furnitures/' . $image_name)
            ]);
        }
    }
}
