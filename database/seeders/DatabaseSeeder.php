<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory(1)->create();
        Supplier::factory(10)->create();

        $this->call([
            CategorySeeder::class,
            Material1Seeder::class,
            Material2Seeder::class,
            Material3Seeder::class,
            Material4Seeder::class,
            FurnitureSeeder::class,
            FurnitureImageSeeder::class,
        ]);
    }
}
