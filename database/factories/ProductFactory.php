<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\SecondaryCategory;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'information' => $this->faker->word(),
            'price' => $this->faker->randomNumber(),
            'is_selling' => $this->faker->boolean(),
            'sort_order' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'shop_id' => Shop::factory(),
            'secondary_category_id' => SecondaryCategory::factory(),
            'image_first' => Image::factory(),
            'image_second' => Image::factory(),
            'image_third' => Image::factory(),
            'image_fourth' => Image::factory(),
        ];
    }
}
