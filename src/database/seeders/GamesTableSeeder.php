<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->insert([
            'title'         => 'テストゲーム1',
            'hardware_type' => 1,
            'category_id'   => 1,
        ]);

        DB::table('games')->insert([
            'title'         => 'テストゲーム2',
            'hardware_type' => 2,
            'category_id'   => 2,
        ]);
    }
}
