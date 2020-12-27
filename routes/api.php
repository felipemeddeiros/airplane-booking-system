<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

/**
 * Booking management routes
 */
Route::prefix('booking')->group(function () {

    Route::get('', [BookingController::class, 'index']);
    Route::delete('', [BookingController::class, 'destroyAll']);
    Route::post('/aircrafts/{aircraft}', [BookingController::class, 'store']);
});
