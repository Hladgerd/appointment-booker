<?php

namespace Database\Seeders;

use App\Models\BusinessTime;
use Illuminate\Database\Seeder;

class BusinessTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // hétköznap 8-20 óráig
        BusinessTime::create([
            'frequency' => "DTSTART:20230101T000000\nRRULE:FREQ=DAILY;BYDAY=MO,TU,WE,TH,FR;BYHOUR=8",
            'duration' => '12:00',
        ]);
    }
}
