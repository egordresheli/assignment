<?php

namespace Database\Factories;

use App\Domain\Containers\Models\Container;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContainerFactory extends Factory
{
    protected $model = Container::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement,
            'width' => fake()->randomFloat(),
            'length' => fake()->randomFloat(),
        ];
    }
}
