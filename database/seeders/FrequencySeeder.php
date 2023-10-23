<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FrequencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('frequencies')->insert([
            ['frequency' => 'One time'],
            ['frequency' => 'Weekly'],
            ['frequency' => 'Even weeks'],
            ['frequency' => 'Odd weeks'],
        ]);
    }
}
