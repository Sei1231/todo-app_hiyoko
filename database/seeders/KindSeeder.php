<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KindSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kinds')->insert([
            ['name' => 'Work', 'color_code' => '#4c2ae5'],
            ['name' => 'Study', 'color_code' => '#3eb7ff'],
            ['name' => 'Family', 'color_code' => '#f387ca'],
            ['name' => 'Hobby', 'color_code' => '#f9a825'],
            ['name' => 'Gym', 'color_code' => '#00c853'],
        ]);
    }
}
