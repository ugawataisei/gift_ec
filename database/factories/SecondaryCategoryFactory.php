<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SecondaryCategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'primary_category_id' => $this->faker->randomNumber(),
            'name' => $this->faker->name(),
            'sort_order' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
