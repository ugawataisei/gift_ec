<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shops')->insert([
            [
                'owner_id' => 1,
                'name' => 'ここに店名が入ります',
                'information' => 'ここに店舗情報が入りますここに店舗情報が入りますここに店舗情報が入りますここに店舗情報が入ります',
                'file_name' => 'sample1.jpg',
                'is_selling' => false,
            ],
            [
                'owner_id' => 2,
                'name' => 'ここに店名が入ります',
                'information' => 'ここに店舗情報が入りますここに店舗情報が入りますここに店舗情報が入りますここに店舗情報が入ります',
                'file_name' => 'sample2.jpg',
                'is_selling' => false,
            ],
            [
                'owner_id' => 3,
                'name' => 'ここに店名が入ります',
                'information' => 'ここに店舗情報が入りますここに店舗情報が入りますここに店舗情報が入りますここに店舗情報が入ります',
                'file_name' => 'sample3.jpg',
                'is_selling' => false,
            ],
        ]);
    }
}

