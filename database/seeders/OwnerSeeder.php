<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('owners')->insert([
            [
                'name' => 'owner1',
                'email' => 'owner1@owner.owner',
                'password' => Hash::make('password'),
                'created_at' => '2022/11/07 00:00:00',
            ],
            [
                'name' => 'owner2',
                'email' => 'owner2@owner.owner',
                'password' => Hash::make('password'),
                'created_at' => '2022/11/07 00:00:00',
            ],
            [
                'name' => 'owner3',
                'email' => 'owner3@owner.owner',
                'password' => Hash::make('password'),
                'created_at' => '2022/11/07 00:00:00',
            ],
        ]);
    }
}
