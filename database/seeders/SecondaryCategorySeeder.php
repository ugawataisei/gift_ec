<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SecondaryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('secondary_categories')->insert([
            [
                'name' => 'ブラックコーヒー',
                'primary_category_id' => 1,
                'sort_order' => 1,
            ],
            [
                'name' => 'カフェオレ',
                'primary_category_id' => 1,
                'sort_order' => 2,
            ],
            [
                'name' => 'ハニーカフェオレ',
                'primary_category_id' => 1,
                'sort_order' => 3,
            ],
            [
                'name' => 'ダークモカチップフラペチーノ',
                'primary_category_id' => 2,
                'sort_order' => 1,
            ],
            [
                'name' => '抹茶フラペチーノ',
                'primary_category_id' => 2,
                'sort_order' => 2,
            ],
            [
                'name' => 'ほうじ茶フラペチーノ',
                'primary_category_id' => 2,
                'sort_order' => 3,
            ],
            [
                'name' => 'ドーナツ',
                'primary_category_id' => 3,
                'sort_order' => 1,
            ],
            [
                'name' => 'チュロス',
                'primary_category_id' => 3,
                'sort_order' => 2,
            ],
            [
                'name' => 'チョコクッキー',
                'primary_category_id' => 3,
                'sort_order' => 3,
            ],
        ]);
    }
}
