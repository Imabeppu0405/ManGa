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
            'title'         => 'gunfire reborn',
            'link'          => 'https://store.steampowered.com/app/1217060/Gunfire_Reborn/?l=japanese',
            'hardware_type' => 1,
            'category_id'   => 1,
        ]);

        DB::table('games')->insert([
            'title'         => 'ゼノブレイド３',
            'link'          => 'https://www.nintendo.co.jp/switch/az3ha/index.html',
            'hardware_type' => 2,
            'category_id'   => 3,
        ]);

        DB::table('games')->insert([
            'title'         => 'マリオ',
            'hardware_type' => 2,
            'category_id'   => 2,
        ]);
    }
}
