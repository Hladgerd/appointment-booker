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
            'from_date' => '20230101T000000',
            'freq' => 'DAILY',
            'by_day' => [1, 2, 3, 4, 5],
            'by_hour' => 8,
            'frequency' => "DTSTART:20230101T000000\nRRULE:FREQ=DAILY;BYDAY=MO,TU,WE,TH,FR;BYHOUR=8",
            'duration' => '12:00',
        ]);
    }
}
