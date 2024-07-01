<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NoteController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\RecapController;

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
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/attendance/history', [AttendanceController::class, 'history']);
    Route::get('/attendance/all-history', [AttendanceController::class, 'allHistory']);
    Route::get('attendance/today', [AttendanceController::class, 'today']);
    Route::post('attendance/filter', [AttendanceController::class, 'filter']);
    Route::post('attendance/check-in', [AttendanceController::class, 'checkIn']);
    Route::post('attendance/check-out', [AttendanceController::class, 'checkOut']);
    Route::get('attendance/{id}', [AttendanceController::class, 'show']);
});

// permissions
Route::middleware('auth:sanctum')->group(function () {
    Route::get('permission/all-history', [PermissionController::class, 'allHistory']);
    Route::post('permission/confirm/{id}', [PermissionController::class, 'confirm']);
    Route::post('permission/filter', [PermissionController::class, 'filter']);
    Route::apiResource('/permission', PermissionController::class);
});

// Recap
Route::get('/recap/staff', [RecapController::class, 'staffRecap'])->middleware('auth:sanctum');
Route::get('/recap/admin', [RecapController::class, 'adminRecap'])->middleware('auth:sanctum');

// notes
Route::apiResource('/note', NoteController::class)->middleware('auth:sanctum');