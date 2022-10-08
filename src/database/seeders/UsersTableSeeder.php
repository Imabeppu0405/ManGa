<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'テスト',
            'email' => 'test@test.com',
            'password' => bcrypt('password123'),
        ]);

        DB::table('users')->insert([
            'name' => 'テスト2',
            'email' => 'test2@test.com',
            'password' => bcrypt('password123'),
        ]);

        DB::table('users')->insert([
            'name' => 'テスト3',
            'email' => 'test3@test.com',
            'password' => bcrypt('password123'),
        ]);
    }
}
