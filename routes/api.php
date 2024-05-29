<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\Api\LedController;
use App\Http\Controllers\LedStatusController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\DeviceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/devices', [DeviceController::class, 'index']);
Route::post('/devices', [DeviceController::class, 'store']);
Route::get('/devices/{id}', [DeviceController::class, 'show']);
Route::put('/devices/{id}', [DeviceController::class, 'update']);
Route::delete('/devices/{id}', [DeviceController::class, 'destroy']);

Route::get('/data', [DataController::class, 'index']);
Route::post('/data', [DataController::class, 'store']);
Route::get('/data/{id}', [DataController::class, 'show']);

Route::get('/led', [LedController::class, 'index']);
Route::post('/led', [LedController::class, 'store']);
Route::get('/led/{id}', [LedController::class, 'show']);
Route::put('/led/{id}', [LedController::class, 'update']);
Route::delete('/led/{id}', [LedController::class, 'destroy']);

Route::get('/ledstatus', [LedStatusController::class, 'index']);
Route::post('/ledstatus', [LedStatusController::class, 'store']);
Route::get('/ledstatus/{id}', [LedStatusController::class, 'show']);


// Route::get('/users', [UserController::class, 'index'])
// Route::get('/users/{id}', [UserController::class, 'show'])
// Route::get('/users', [UserController::class, 'store'])
// Route::get('/users/{id}', [UserController::class, 'update'])
// Route::get('/users/{id}', [UserController::class, 'destroy'])

Route::resource('users', UserController::class)
    ->except(['create', 'edit']);
