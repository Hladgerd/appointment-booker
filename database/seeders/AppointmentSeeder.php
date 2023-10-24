<?php

namespace Database\Seeders;

use App\Enums\DayEnum;
use App\Models\Appointment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'start_date' => '2023-09-08',
                'start_time' => '08:00:00',
                'end_time' => '10:00:00',
                'frequency_id' => 1,
            ],
            [
                'client_name' => fake()->name(),
                'start_date' => '2023-01-01',
                'start_time' => '10:00:00',
                'end_time' => '12:00:00',
                'frequency_id' => 3,
                'day' => DayEnum::MONDAY->value,
            ],
            [
                'client_name' => fake()->name(),
                'start_date' => '2023-01-01',
                'start_time' => '12:00:00',
                'end_time' => '16:00:00',
                'frequency_id' => 4,
                'day' => DayEnum::WEDNESDAY->value,
            ],
            [
                'client_name' => fake()->name(),
                'start_date' => '2023-01-01',
                'start_time' => '10:00:00',
                'end_time' => '16:00:00',
                'frequency_id' => 2,
                'day' => DayEnum::FRIDAY->value,
            ],
            [
                'client_name' => fake()->name(),
                'start_date' => '2023-06-01',
                'end_date' => '2023-11-30',
                'start_time' => '16:00:00',
                'end_time' => '20:00:00',
                'frequency_id' => 2,
                'day' => DayEnum::THURSDAY->value,
            ],

        ];

        foreach ($appointments as $appointment) {
            Appointment::create($appointment);
        }
    }
}
