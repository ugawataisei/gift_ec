<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'shop_id' => 1,
                'secondary_category_id' => 1,
                'image_first' => 1,
                'image_second' => 2,
                'image_third' => 3,
                'image_fourth' => 4,
                'name' => 'ここに商品名が入ります',
                'information' => 'ここに商品情報が入りますここに商品情報が入ります
                ここに商品情報が入りますここに商品情報が入ります',
                'price' => 1000,
                'is_selling' => true,
                'sort_order' => 1,
            ],
            [
                'shop_id' => 2,
                'secondary_category_id' => 2,
                'image_first' => 1,
                'image_second' => 2,
                'image_third' => 3,
                'image_fourth' => 4,
                'name' => 'ここに商品名が入ります',
                'information' => 'ここに商品情報が入りますここに商品情報が入ります
                ここに商品情報が入りますここに商品情報が入ります',
                'price' => 1000,
                'is_selling' => true,
                'sort_order' => 1,
            ],
            [
                'shop_id' => 3,
                'secondary_category_id' => 3,
                'image_first' => 1,
                'image_second' => 2,
                'image_third' => 3,
                'image_fourth' => 4,
                'name' => 'ここに商品名が入ります',
                'information' => 'ここに商品情報が入りますここに商品情報が入ります
                ここに商品情報が入りますここに商品情報が入ります',
                'price' => 1000,
                'is_selling' => true,
                'sort_order' => 1,
            ],
        ]);
    }
}
