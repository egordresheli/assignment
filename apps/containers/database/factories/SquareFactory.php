<?php

namespace Database\Factories;

use App\Domain\Objects\Models\Square;
use Illuminate\Database\Eloquent\Factories\Factory;

class SquareFactory extends Factory
{
    protected $model = Square::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'width' => fake()->randomFloat(),
            'length' => fake()->randomFloat(),
        ];
    }
}
