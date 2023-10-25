<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BusinessTimeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| API routes to listing appointments and business hours
| and to store new appointment
*/

Route::get('/appointments', [AppointmentController::class, 'index']);
Route::post('/appointments', [AppointmentController::class, 'store']);
Route::get('/business-hours', [BusinessTimeController::class, 'index']);
