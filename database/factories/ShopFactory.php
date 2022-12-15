<?php

namespace Database\Factories;

use App\Models\Owner;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ShopFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'information' => $this->faker->word(),
            'file_name' => $this->faker->name(),
            'is_selling' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'owner_id' => Owner::factory(),
        ];
    }
}
