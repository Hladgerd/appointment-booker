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
                'client_name' => fake()->name(),
                'start' => '2023-09-08 08:00:00',
                'end' => '2023-09-08 10:00:00',
            ],
            [
                'client_name' => fake()->name(),
                'start' => '2023-10-08 08:00:00',
                'end' => '2023-10-08 10:00:00',
            ],
            [
                'client_name' => fake()->name(),
                'start' => '2023-10-10 12:00:00',
                'end' => '2023-10-10 16:00:00',
            ],
        ];

        foreach ($appointments as $appointment) {
            Appointment::create($appointment);
        }
    }
}
