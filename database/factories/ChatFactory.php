<?php

namespace Database\Factories;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChatFactory extends Factory
{
    protected $model = Chat::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->optional()->company(),
            'type' => $this->faker->randomElement(['private', 'group']),
            'university' => $this->faker->optional()->randomElement(['KBTU', 'SDU', 'KazNU']),
        ];
    }

    public function group(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'group',
            'name' => $this->faker->company(),
        ]);
    }

    public function private(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'private',
            'name' => null,
            'university' => null,
        ]);
    }
}
