<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->name(),
            'company' => fake()->company(),
            'phone' => '08' . mt_rand(999999999, 9999999999),
            'address' => fake()->address(),
            'skill' => fake()->jobTitle()
        ];
    }
}
