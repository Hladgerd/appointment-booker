<?php

namespace Tests\Feature;

use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AppointmentControllerTest extends TestCase
{
    private static string $validUri = '/api/appointments/';
    private static string $invalidUri = '/api/appoint/';


    /**
     * Get appointments
     */
    public function test_valid_get_request_returns_ok_response_code(): void
    {
        $this->json('get', self::$validUri)
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_get_request_invalid_uri_returns_error_message(): void
    {
        $this->json('get', self::$invalidUri)
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJson([
                'message' => 'The route api/appoint could not be found.',
            ]);
    }


    /**
     * Create onetime appointment
     */
    public function test_valid_post_request_returns_created_response_code(): void
    {
        $payload = [
            'clientName' => 'Test Client',
            'start' => '2023-11-09 08:00:00',
            'end' => '2023-11-09 09:00:00',
            'dayOfWeek' => 4,
            'startHour' => 8,
            'endHour' => 9,
            'endMinutes' => 0,
        ];

        $this->json('post', self::$validUri, $payload)
            ->assertStatus(Response::HTTP_CREATED);
    }

    public function test_post_request_invalid_uri_returns_error_message(): void
    {
        $payload = [
            'clientName' => 'Test Client',
            'start' => '2023-11-09 09:00:00',
            'end' => '2023-11-09 10:00:00',
            'dayOfWeek' => 4,
            'startHour' => 9,
            'endHour' => 10,
            'endMinutes' => 0,
        ];

        $this->json('post', self::$invalidUri, $payload)
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJson([
                'message' => 'The route api/appoint could not be found.',
            ]);
    }

    public function test_post_request_with_end_before_start_returns_error_message(): void
    {
        $payload = [
            'clientName' => 'Test Client',
            'start' => '2023-12-05 10:00:00',
            'end' => '2023-12-05 09:00:00',
            'dayOfWeek' => 2,
            'startHour' => 10,
            'endHour' => 9,
            'endMinutes' => 0,
        ];

        $this->json('post', self::$validUri, $payload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'The end field must be a date after start.'
            ]);
    }

    public function test_post_request_with_non_business_day_returns_error_message(): void
    {
        $payload = [
            'clientName' => 'Test Client',
            'start' => '2023-11-25 08:00:00',
            'end' => '2023-11-25 09:00:00',
            'dayOfWeek' => 6,
            'startHour' => 8,
            'endHour' => 9,
            'endMinutes' => 0,
        ];

        $this->json('post', self::$validUri, $payload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'A foglalás nyitvatartási időn kívül esik!'
            ]);
    }

    public function test_post_request_with_non_business_hours_returns_error_message(): void
    {
        $payload = [
            'clientName' => 'Test Client',
            'start' => '2023-11-24 06:00:00',
            'end' => '2023-11-24 09:00:00',
            'dayOfWeek' => 5,
            'startHour' => 6,
            'endHour' => 9,
            'endMinutes' => 0,
        ];

        $this->json('post', self::$validUri, $payload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'A foglalás nyitvatartási időn kívül esik!'
            ]);
    }

    public function test_post_request_with_booked_onetime_appointment_returns_error_message(): void
    {
        $payload = [
            'clientName' => 'Test Client',
            'start' => '2023-11-09 08:00:00',
            'end' => '2023-11-09 09:00:00',
            'dayOfWeek' => 4,
            'startHour' => 8,
            'endHour' => 9,
            'endMinutes' => 0,
        ];

        $this->json('post', self::$validUri, $payload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'Az időpont már foglalt!'
            ]);
    }

    public function test_post_request_with_booked_recurring_appointment_returns_error_message(): void
    {
        $payload = [
            'clientName' => 'Test Client',
            'start' => '2023-12-11 10:00:00',
            'end' => '2023-12-11 11:00:00',
            'dayOfWeek' => 4,
            'startHour' => 8,
            'endHour' => 9,
            'endMinutes' => 0,
        ];

        $this->json('post', self::$validUri, $payload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'Az időpont már foglalt!'
            ]);
    }
}
