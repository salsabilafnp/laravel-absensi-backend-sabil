<?php

use App\Http\Controllers\Api\AttendanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// login
Route::post('/login', [AuthController::class, 'login']);
// logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
// update profile
Route::post('/update-profile', [AuthController::class, 'updateProfile'])->middleware('auth:sanctum');

// companies
// index
Route::get('/company', [CompanyController::class, 'index'])->middleware('auth:sanctum');

// attendances
// check in
Route::post('/attendance/check-in', [AttendanceController::class, 'checkIn'])->middleware('auth:sanctum');
// check out
Route::post('/attendance/check-out', [AttendanceController::class, 'checkOut'])->middleware('auth:sanctum');
// checked in
Route::get('/attendance/is-checkedIn', [AttendanceController::class, 'isCheckedIn'])->middleware('auth:sanctum');
