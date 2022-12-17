<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stocks')->insert([
            [
                'product_id' => 1,
                'type' => 1,
                'quantity' => 5,
            ],
            [
                'product_id' => 2,
                'type' => 1,
                'quantity' => 5,
            ],
            [
                'product_id' => 3,
                'type' => 1,
                'quantity' => 5,
            ],
            [
                'product_id' => 4,
                'type' => 1,
                'quantity' => 5,
            ],
            [
                'product_id' => 5,
                'type' => 1,
                'quantity' => 5,
            ],
            [
                'product_id' => 6,
                'type' => 1,
                'quantity' => 5,
            ],
            [
                'product_id' => 7,
                'type' => 1,
                'quantity' => 5,
            ],
            [
                'product_id' => 8,
                'type' => 1,
                'quantity' => 5,
            ],
            [
                'product_id' => 9,
                'type' => 1,
                'quantity' => 5,
            ],
            [
                'product_id' => 10,
                'type' => 1,
                'quantity' => 5,
            ],
        ]);
    }
}
