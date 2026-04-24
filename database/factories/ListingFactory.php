<?php

namespace Database\Factories;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ListingFactory extends Factory
{
    protected $model = Listing::class;
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->numberBetween(50000, 200000),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->randomElement(['Almaty', 'Astana', 'Shymkent']),
            'rooms' => $this->faker->numberBetween(1, 4),
            'roommates_needed' => $this->faker->numberBetween(1, 3),
            'type' => $this->faker->randomElement(['looking_for_room', 'offering_room']),
            'image' => null,
            'status' => 'active',
        ];
    }
}
