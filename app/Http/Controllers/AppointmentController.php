<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the appointments.
     */
    public function index(): JsonResponse
    {
        $appointments = Appointment::all();
        $events = array();

        foreach ($appointments as $appointment) {
            $events[] = [
                'title' => $appointment->client_name,
                'start' => $appointment->start,
                'end' => $appointment->end,
                'rrule' => $appointment->frequency,
                'duration' => $appointment->duration,
            ];
        }
        return response()->json($events);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request): JsonResponse
    {
        $validatedRequest = $request->safe()->all();
        try {
            $appointment = Appointment::create([
                'client_name' => $validatedRequest['clientName'],
                'start' => Carbon::parse($validatedRequest['start'])->toDateTimeString(),
                'end' => Carbon::parse($validatedRequest['end'])->toDateTimeString(),
            ]);
            return response()->json(['message' => $appointment], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
