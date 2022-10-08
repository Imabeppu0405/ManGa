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
            'memo'          => 'ローグライク要素もあり、面白そう',
            'game_id'       => 1,
            'user_id'       => 1,
            'status_id'     => 1,
        ]);

        DB::table('reports')->insert([
            'game_id'       => 2,
            'user_id'       => 1,
            'status_id'     => 2,
            'start_at'      => now(),
        ]);

        DB::table('reports')->insert([
            'memo'          => 'とても難しかった',
            'game_id'       => 1,
            'user_id'       => 2,
            'status_id'     => 1,
            'start_at'      => now(),
        ]);
    }
}
