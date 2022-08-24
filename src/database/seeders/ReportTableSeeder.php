<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reports')->insert([
            'memo'          => 'コントローラ必須',
            'game_id'       => 1,
            'user_id'       => 1,
            'status_id'     => 0,
            'start_at'      => now(),
            'end_at'        => now()
        ]);

        DB::table('reports')->insert([
            'memo'          => 'コントローラはいらない',
            'game_id'       => 2,
            'user_id'       => 1,
            'status_id'     => 1,
            'start_at'      => now(),
            'end_at'        => now()
        ]);
    }
}
