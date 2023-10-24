<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Appointment::truncate();

        $appointments = [
            [
                // 2023-09-08-án 8-10 óra
                'client_name' => fake()->name(),
                'start' => '2023-09-08 08:00:00',
                'end' => '2023-09-08 10:00:00',
            ],
            [
                // 2023-01-01-től minden páros héten hétfőn 10-12 óra
                'client_name' => fake()->name(),
                'frequency' => "DTSTART:20230109T000000Z\nRRULE:FREQ=WEEKLY;INTERVAL=2;BYDAY=MO;BYHOUR=10",
                'duration' => '02:00',
            ],
            [
                // 2023-01-01-től minden páratlan héten szerda 12-16 óra
                'client_name' => fake()->name(),
                'frequency' => "DTSTART:20230102T000000\nRRULE:FREQ=WEEKLY;INTERVAL=2;BYDAY=WE;BYHOUR=12",
                'duration' => '04:00',
            ],
            [
                // 2023-01-01-től minden héten pénteken 10-16 óra
                'client_name' => fake()->name(),
                'frequency' => "DTSTART:20230106T000000\nRRULE:FREQ=WEEKLY;BYDAY=FR;BYHOUR=10",
                'duration' => '06:00',
            ],
            [
                // 2023-06-01-től 2023-11-30-ig minden héten csütörtökön 16-20 óra
                'client_name' => fake()->name(),
                'frequency' => "DTSTART:20230601T000000\nRRULE:FREQ=WEEKLY;BYDAY=TH;BYHOUR=16;UNTIL=20231130T000000",
                'duration' => '04:00',
            ],
        ];

        foreach ($appointments as $appointment) {
            Appointment::create($appointment);
        }
    }
}
