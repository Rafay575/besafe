<?php

use App\Http\Controllers\Api\HazardApiController;
use App\Http\Controllers\Api\IncidentAsssignApiController;
use App\Http\Controllers\Api\MetaDataApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::post('login', [UserApiController::class, 'authUserLogin']);
Route::post('register', [UserApiController::class, 'registerUser']);
Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::post('/user/{user_id}/update', [UserApiController::class, 'update']);
    Route::get('/user', [UserApiController::class, 'show']);
    Route::get('/meta-data', [MetaDataApiController::class, 'index']);
    Route::get('/hazards', [HazardApiController::class, 'index']);
    Route::post('/hazards/create', [HazardApiController::class, 'store']);
    Route::get('/hazards/{hazard_id}/show', [HazardApiController::class, 'show']);
    Route::post('/hazards/{hazard_id}/update', [HazardApiController::class, 'update']);
    Route::post('/hazards/{hazard_id}/assign', [HazardApiController::class, 'assign']);
    Route::delete('/hazards/{hazard_id}/delete', [HazardApiController::class, 'destroy']);
    Route::post('/incident_assign/{incident_assign_id}/update', [IncidentAsssignApiController::class, 'update']);

});