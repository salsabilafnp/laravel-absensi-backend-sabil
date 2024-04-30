<?php

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

// companies
// index
Route::get('/company', [CompanyController::class, 'index'])->middleware('auth:sanctum');
// create
Route::post('/company/create', [CompanyController::class, 'store'])->middleware('auth:sanctum');
// update
Route::put('/company/{id}', [CompanyController::class, 'update'])->middleware('auth:sanctum');
// destroy
Route::delete('/company/{id}', [CompanyController::class, 'destroy'])->middleware('auth:sanctum');