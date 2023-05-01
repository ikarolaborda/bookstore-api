<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'ISBN' => $this->faker->unique()->numberBetween(1000000000, 9999999999),
            'value' => $this->faker->randomFloat(2, 1, 100),
        ];
    }
}
