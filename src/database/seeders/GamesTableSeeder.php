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
            'memo'          => 'コントローラ必須',
            'user_id'       => 1,
            'hardware_type' => 0,
            'status_id'     => 0,
            'start_at'      => now(),
            'end_at'        => now()
        ]);

        DB::table('games')->insert([
            'title'         => 'テストゲーム2',
            'memo'          => 'キーボードがやりやすい',
            'user_id'       => 1,
            'hardware_type' => 1,
            'status_id'     => 1,
            'start_at'      => now(),
            'end_at'        => now()
        ]);
    }
}
