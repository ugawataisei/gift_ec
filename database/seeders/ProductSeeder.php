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
                'image_second' => null,
                'image_third' => null,
                'image_fourth' => null,
                'name' => 'ここに商品名が入ります',
                'information' => 'ここに商品情報が入りますここに商品情報が入ります
                ここに商品情報が入りますここに商品情報が入ります',
                'price' => 1000,
                'is_selling' => true,
                'sort_order' => 1,
            ],
            [
                'shop_id' => 1,
                'secondary_category_id' => 1,
                'image_first' => 2,
                'image_second' => null,
                'image_third' => null,
                'image_fourth' => null,
                'name' => 'ここに商品名が入ります',
                'information' => 'ここに商品情報が入りますここに商品情報が入ります
                ここに商品情報が入りますここに商品情報が入ります',
                'price' => 1000,
                'is_selling' => true,
                'sort_order' => 1,
            ],
            [
                'shop_id' => 1,
                'secondary_category_id' => 1,
                'image_first' => 3,
                'image_second' => null,
                'image_third' => null,
                'image_fourth' => null,
                'name' => 'ここに商品名が入ります',
                'information' => 'ここに商品情報が入りますここに商品情報が入ります
                ここに商品情報が入りますここに商品情報が入ります',
                'price' => 1000,
                'is_selling' => true,
                'sort_order' => 1,
            ],
            [
                'shop_id' => 1,
                'secondary_category_id' => 1,
                'image_first' => 4,
                'image_second' => null,
                'image_third' => null,
                'image_fourth' => null,
                'name' => 'ここに商品名が入ります',
                'information' => 'ここに商品情報が入りますここに商品情報が入ります
                ここに商品情報が入りますここに商品情報が入ります',
                'price' => 1000,
                'is_selling' => true,
                'sort_order' => 1,
            ],
            [
                'shop_id' => 1,
                'secondary_category_id' => 1,
                'image_first' => 5,
                'image_second' => null,
                'image_third' => null,
                'image_fourth' => null,
                'name' => 'ここに商品名が入ります',
                'information' => 'ここに商品情報が入りますここに商品情報が入ります
                ここに商品情報が入りますここに商品情報が入ります',
                'price' => 1000,
                'is_selling' => true,
                'sort_order' => 1,
            ],
            [
                'shop_id' => 1,
                'secondary_category_id' => 1,
                'image_first' => 6,
                'image_second' => null,
                'image_third' => null,
                'image_fourth' => null,
                'name' => 'ここに商品名が入ります',
                'information' => 'ここに商品情報が入りますここに商品情報が入ります
                ここに商品情報が入りますここに商品情報が入ります',
                'price' => 1000,
                'is_selling' => true,
                'sort_order' => 1,
            ],
            [
                'shop_id' => 1,
                'secondary_category_id' => 1,
                'image_first' => 7,
                'image_second' => null,
                'image_third' => null,
                'image_fourth' => null,
                'name' => 'ここに商品名が入ります',
                'information' => 'ここに商品情報が入りますここに商品情報が入ります
                ここに商品情報が入りますここに商品情報が入ります',
                'price' => 1000,
                'is_selling' => true,
                'sort_order' => 1,
            ],
            [
                'shop_id' => 1,
                'secondary_category_id' => 1,
                'image_first' => 8,
                'image_second' => null,
                'image_third' => null,
                'image_fourth' => null,
                'name' => 'ここに商品名が入ります',
                'information' => 'ここに商品情報が入りますここに商品情報が入ります
                ここに商品情報が入りますここに商品情報が入ります',
                'price' => 1000,
                'is_selling' => true,
                'sort_order' => 1,
            ],
            [
                'shop_id' => 1,
                'secondary_category_id' => 1,
                'image_first' => 9,
                'image_second' => null,
                'image_third' => null,
                'image_fourth' => null,
                'name' => 'ここに商品名が入ります',
                'information' => 'ここに商品情報が入りますここに商品情報が入ります
                ここに商品情報が入りますここに商品情報が入ります',
                'price' => 1000,
                'is_selling' => true,
                'sort_order' => 1,
            ],
            [
                'shop_id' => 1,
                'secondary_category_id' => 1,
                'image_first' => 10,
                'image_second' => null,
                'image_third' => null,
                'image_fourth' => null,
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
