<?php

namespace App\Http\Controllers;

use App\Models\BusinessTime;
use Illuminate\Http\JsonResponse;

class BusinessTimeController extends Controller
{
    /**
     * Display a listing of the business time.
     */
    public function index(): JsonResponse
    {
        $businessHours = BusinessTime::all();
        $events = array();

        foreach ($businessHours as $businessHour) {
            $events[] = [
                'rrule' => $businessHour->rrule,
                'duration' => $businessHour->duration,
                'display' => 'inverse-background',
            ];
        }
        return response()->json($events);
    }
}
