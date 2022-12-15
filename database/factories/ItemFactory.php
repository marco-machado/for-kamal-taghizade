<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->name(),
            'file' => storage_path('app') . '/files/' . $this->faker->file('/tmp', 'storage/app/files', false),
            'type' => $this->faker->numberBetween(1, 3),
        ];
    }
}
