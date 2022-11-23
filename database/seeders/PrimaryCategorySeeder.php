<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrimaryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('primary_categories')->insert([
            [
                'name' => 'コーヒー',
                'sort_order' => 1,
            ],
            [
                'name' => 'フラペチーノ',
                'sort_order' => 1,
            ],
            [
                'name' => 'サイドメニュー',
                'sort_order' => 1,
            ],
        ]);
    }
}
