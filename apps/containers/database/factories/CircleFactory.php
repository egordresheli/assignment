<?php

namespace Database\Factories;

use App\Domain\Objects\Models\Circle;
use Illuminate\Database\Eloquent\Factories\Factory;

class CircleFactory extends Factory
{
    protected $model = Circle::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'radius' => fake()->randomFloat(),
        ];
    }
}
