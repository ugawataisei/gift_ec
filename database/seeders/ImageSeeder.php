<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
            [
                'owner_id' => 1,
                'file_name' => 'sample1.jpg',
                'title' => '商品1',
            ],
            [
                'owner_id' => 1,
                'file_name' => 'sample2.jpg',
                'title' => '商品2',
            ],
            [
                'owner_id' => 1,
                'file_name' => 'sample3.jpg',
                'title' => '商品3',
            ],
            [
                'owner_id' => 1,
                'file_name' => 'sample4.jpg',
                'title' => '商品4',
            ],
            [
                'owner_id' => 1,
                'file_name' => 'sample5.jpg',
                'title' => '商品5',
            ],
            [
                'owner_id' => 1,
                'file_name' => 'sample6.jpg',
                'title' => '商品6',
            ],
            [
                'owner_id' => 1,
                'file_name' => 'sample7.jpg',
                'title' => '商品7',
            ],
            [
                'owner_id' => 1,
                'file_name' => 'sample8.jpg',
                'title' => '商品8',
            ],
            [
                'owner_id' => 1,
                'file_name' => 'sample9.jpg',
                'title' => '商品9',
            ],
            [
                'owner_id' => 1,
                'file_name' => 'sample10.jpg',
                'title' => '商品10',
            ],
        ]);
    }
}
