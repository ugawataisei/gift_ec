<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'user1',
                'email' => 'user1@user.user',
                'password' => Hash::make('password'),
                'created_at' => '2022/11/07 00:00:00',
            ],
            [
                'name' => 'user2',
                'email' => 'user2@user.user',
                'password' => Hash::make('password'),
                'created_at' => '2022/11/07 00:00:00',
            ],
            [
                'name' => 'user3',
                'email' => 'user3@user.user',
                'password' => Hash::make('password'),
                'created_at' => '2022/11/07 00:00:00',
            ],
        ]);
    }
}
