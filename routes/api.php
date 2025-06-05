<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\TravelPackageController;
use App\Http\Controllers\GeoServiceController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/packages', [TravelPackageController::class, 'store']);
    Route::get('/packages-eager-load', [TravelPackageController::class, 'index']);
    Route::get('/packages-with-join', [TravelPackageController::class, 'indexWithJoin']);
    Route::get('/geo/save-output', [GeoServiceController::class, 'saveOutput']);
});
