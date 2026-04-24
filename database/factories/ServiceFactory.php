<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = Service::class;
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory()->service(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->numberBetween(1000, 100000),
            'price_type' => $this->faker->randomElement(['fixed', 'hourly', 'negotiable']),
            'image' => null,
            'status' => 'active',
        ];
    }
}
