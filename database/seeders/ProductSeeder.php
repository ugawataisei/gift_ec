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
                'name' => '商品1',
                'information' => 'ここに商品情報が入りますここに商品情報が入ります
                ここに商品情報が入りますここに商品情報が入ります',
                'price' => 500,
                'is_selling' => true,
                'sort_order' => 1,
            ],
            [
                'shop_id' => 1,
                'secondary_category_id' => 2,
                'image_first' => 2,
                'image_second' => null,
                'image_third' => null,
                'image_fourth' => null,
                'name' => '商品2',
                'information' => 'ここに商品情報が入りますここに商品情報が入ります
                ここに商品情報が入りますここに商品情報が入ります',
                'price' => 530,
                'is_selling' => true,
                'sort_order' => 1,
            ],
            [
                'shop_id' => 1,
                'secondary_category_id' => 3,
                'image_first' => 3,
                'image_second' => null,
                'image_third' => null,
                'image_fourth' => null,
                'name' => '商品3',
                'information' => 'ここに商品情報が入りますここに商品情報が入ります
                ここに商品情報が入りますここに商品情報が入ります',
                'price' => 520,
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
                'name' => '商品4',
                'information' => 'ここに商品情報が入りますここに商品情報が入ります
                ここに商品情報が入りますここに商品情報が入ります',
                'price' => 650,
                'is_selling' => true,
                'sort_order' => 1,
            ],
            [
                'shop_id' => 1,
                'secondary_category_id' => 2,
                'image_first' => 5,
                'image_second' => null,
                'image_third' => null,
                'image_fourth' => null,
                'name' => '商品5',
                'information' => 'ここに商品情報が入りますここに商品情報が入ります
                ここに商品情報が入りますここに商品情報が入ります',
                'price' => 720,
                'is_selling' => true,
                'sort_order' => 1,
            ],
            [
                'shop_id' => 1,
                'secondary_category_id' => 3,
                'image_first' => 6,
                'image_second' => null,
                'image_third' => null,
                'image_fourth' => null,
                'name' => '商品6',
                'information' => 'ここに商品情報が入りますここに商品情報が入ります
                ここに商品情報が入りますここに商品情報が入ります',
                'price' => 240,
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
                'name' => '商品7',
                'information' => 'ここに商品情報が入りますここに商品情報が入ります
                ここに商品情報が入りますここに商品情報が入ります',
                'price' => 398,
                'is_selling' => true,
                'sort_order' => 1,
            ],
            [
                'shop_id' => 1,
                'secondary_category_id' => 2,
                'image_first' => 8,
                'image_second' => null,
                'image_third' => null,
                'image_fourth' => null,
                'name' => '商品8',
                'information' => 'ここに商品情報が入りますここに商品情報が入ります
                ここに商品情報が入りますここに商品情報が入ります',
                'price' => 980,
                'is_selling' => true,
                'sort_order' => 1,
            ],
            [
                'shop_id' => 1,
                'secondary_category_id' => 3,
                'image_first' => 9,
                'image_second' => null,
                'image_third' => null,
                'image_fourth' => null,
                'name' => '商品9',
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
                'name' => '商品10',
                'information' => 'ここに商品情報が入りますここに商品情報が入ります
                ここに商品情報が入りますここに商品情報が入ります',
                'price' => 120,
                'is_selling' => true,
                'sort_order' => 1,
            ],
        ]);
    }
}
