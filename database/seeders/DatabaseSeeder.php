<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            OwnerSeeder::class,
            UserSeeder::class,
            ShopSeeder::class,
            ImageSeeder::class,
            PrimaryCategorySeeder::class,
            SecondaryCategorySeeder::class,
            ProductSeeder::class,
            StockSeeder::class,
        ]);
    }
}
