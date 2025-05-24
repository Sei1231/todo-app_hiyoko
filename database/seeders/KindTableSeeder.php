<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KindTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kinds')->insert([
            ['name' => 'TODAY', 'color-code' => '00ff7f'],
            ['name' => '勉強', 'color-code' => 'ff00ff'],
            ['name' => '家族', 'color-code' => '00008d'],
            ['name' => '娯楽', 'color-code' => 'ff8c00'],
            ['name' => 'バイト', 'color-code' => '4d0082'],
            ['name' => 'その他', 'color-code' => '000000'],
        ]);
    }
}
