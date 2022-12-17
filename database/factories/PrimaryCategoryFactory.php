<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PrimaryCategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'sort_order' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
