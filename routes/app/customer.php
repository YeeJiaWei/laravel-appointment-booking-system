<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

// Booking
Route::get('/bookings', [BookingController::class, 'indexCustomer']);
Route::get('/bookings/new', function () {
	return redirect('/bookings/' . toMonthYear(getNow()) . '/new');
});
Route::get('/bookings/{month_year}/new', [BookingController::class, 'createCustomer']);
Route::get('/bookings/{month_year}/new/{employee}', [BookingController::class, 'createCustomer']);
Route::post('/bookings', [BookingController::class, 'store']);
