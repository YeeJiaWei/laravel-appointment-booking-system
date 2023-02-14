<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\BusinessOwnerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BusinessTimeController;
use App\Http\Controllers\WorkingTimeController;
use Illuminate\Support\Facades\Route;

// Admin views
Route::get('/admin', [BusinessOwnerController::class, 'index']);
Route::get('/admin/register', [BusinessOwnerController::class, 'register']);

// Business Info
Route::get('/admin/edit', [BusinessOwnerController::class, 'edit']);
Route::put('/admin/{bo}', [BusinessOwnerController::class, 'update']);

// Business Times
Route::resource('admin/times', BusinessTimeController::class)
    ->except(['create']);

// Employees
Route::get('/admin/employees', [EmployeeController::class, 'index']);
Route::get('/admin/employees/assign', [EmployeeController::class, 'assign']);
Route::get('/admin/employees/assign/{employee_id}', [EmployeeController::class, 'assign']);
Route::post('/admin/employees/assign', [BookingController::class, 'assignEmployee']);

// Roster
Route::get('/admin/roster', function () {
    return redirect('/admin/roster/' . toMonthYear(getNow()));
});
Route::get('/admin/roster/{month_year}', [WorkingTimeController::class, 'index']);
Route::get('/admin/roster/{month_year}/{employee_id}', [WorkingTimeController::class, 'show']);
Route::get('/admin/roster/{month_year}/{employee_id}/{working_time_id}/edit', [WorkingTimeController::class, 'edit']);
Route::put('/admin/roster/{wTime}', [WorkingTimeController::class, 'update']);
Route::post('/admin/roster', [WorkingTimeController::class, 'store']);
Route::post('/admin/roster/{month_year}', [WorkingTimeController::class, 'store']);
Route::delete('/admin/roster/{wTime}', [WorkingTimeController::class, 'destroy']);

// Booking
Route::get('/admin/summary', [BookingController::class, 'summary']);
Route::get('/admin/history', [BookingController::class, 'history']);
Route::get('/admin/bookings', function () {
    return redirect('/admin/bookings/' . toMonthYear(getNow()));
});
Route::get('/admin/bookings/{month_year}', [BookingController::class, 'indexAdmin']);
Route::get('/admin/bookings/{month_year}/{employee_id}', [BookingController::class, 'showAdmin']);
Route::post('/admin/bookings/{month_year}', [BookingController::class, 'store']);
Route::post('/admin/bookings', [BookingController::class, 'store']);

// Employee
Route::post('/admin/employees', [EmployeeController::class, 'store']);

// Business registration for
Route::post('/admin/register', [BusinessOwnerController::class, 'store']);

// Activity management
// Custom modified resourceful controller using CRUD routes
Route::resource('admin/activity', ActivityController::class)
    ->except(['create']);

Route::resource('admin/booking', BookingController::class)
    ->only(['edit', 'update', 'destroy']);
