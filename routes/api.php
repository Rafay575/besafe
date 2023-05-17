<?php

use App\Http\Controllers\Api\FirePropertyDamageApiController;
use App\Http\Controllers\Api\HazardApiController;
use App\Http\Controllers\Api\IncidentAsssignApiController;
use App\Http\Controllers\Api\InjuryApiController;
use App\Http\Controllers\Api\MetaDataApiController;
use App\Http\Controllers\Api\NearMissApiController;
use App\Http\Controllers\Api\PermitToWorkApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\UserController;
use App\UnsafeBehaviorApiController;
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


    // hazards realted apis
    Route::get('/hazards', [HazardApiController::class, 'index']);
    Route::post('/hazards/create', [HazardApiController::class, 'store']);
    Route::get('/hazards/{hazard_id}/show', [HazardApiController::class, 'show']);
    Route::post('/hazards/{hazard_id}/update', [HazardApiController::class, 'update']);
    Route::post('/hazards/{hazard_id}/assign', [HazardApiController::class, 'assign']);
    Route::delete('/hazards/{hazard_id}/delete', [HazardApiController::class, 'destroy']);

    // unsafe behavior related apis
    Route::get('/unsafe_behaviors', [UnsafeBehaviorApiController::class, 'index']);
    Route::post('/unsafe_behaviors/create', [UnsafeBehaviorApiController::class, 'store']);
    Route::get('/unsafe_behaviors/{unsafe_behavior_id}/show', [UnsafeBehaviorApiController::class, 'show']);
    Route::post('/unsafe_behaviors/{unsafe_behavior_id}/update', [UnsafeBehaviorApiController::class, 'update']);
    Route::post('/unsafe_behaviors/{unsafe_behavior_id}/assign', [UnsafeBehaviorApiController::class, 'assign']);
    Route::delete('/unsafe_behaviors/{unsafe_behavior_id}/delete', [UnsafeBehaviorApiController::class, 'destroy']);


    // near miss apis
    Route::get('/near_misses', [NearMissApiController::class, 'index']);
    Route::post('/near_misses/create', [NearMissApiController::class, 'store']);
    Route::get('/near_misses/{near_miss_id}/show', [NearMissApiController::class, 'show']);
    Route::post('/near_misses/{near_miss_id}/update', [NearMissApiController::class, 'update']);
    Route::post('/near_misses/{near_miss_id}/assign', [NearMissApiController::class, 'assign']);
    Route::delete('/near_misses/{near_miss_id}/delete', [NearMissApiController::class, 'destroy']);

    // fire and proeprty damages apis
    Route::get('/fpdamages', [FirePropertyDamageApiController::class, 'index']);
    Route::post('/fpdamages/create', [FirePropertyDamageApiController::class, 'store']);
    Route::get('/fpdamages/{fpdamage_id}/show', [FirePropertyDamageApiController::class, 'show']);
    Route::post('/fpdamages/{fpdamage_id}/update', [FirePropertyDamageApiController::class, 'update']);
    Route::post('/fpdamages/{fpdamage_id}/assign', [FirePropertyDamageApiController::class, 'assign']);
    Route::delete('/fpdamages/{fpdamage_id}/delete', [FirePropertyDamageApiController::class, 'destroy']);


    // injury apis
    Route::get('/injuries', [InjuryApiController::class, 'index']);
    Route::post('/injuries/create', [InjuryApiController::class, 'store']);
    Route::get('/injuries/{injury_id}/show', [InjuryApiController::class, 'show']);
    Route::post('/injuries/{injury_id}/update', [InjuryApiController::class, 'update']);
    Route::post('/injuries/{injury_id}/assign', [InjuryApiController::class, 'assign']);
    Route::delete('/injuries/{injury_id}/delete', [InjuryApiController::class, 'destroy']);


    // permission to work apis
    Route::get('/ptws', [PermitToWorkApiController::class, 'index']);
    Route::post('/ptws/create', [PermitToWorkApiController::class, 'store']);
    Route::get('/ptws/{ptw_id}/show', [PermitToWorkApiController::class, 'show']);
    Route::post('/ptws/{ptw_id}/update', [PermitToWorkApiController::class, 'update']);
    Route::delete('/ptws/{ptw_id}/delete', [PermitToWorkApiController::class, 'destroy']);








    Route::post('/incident_assign/{incident_assign_id}/update', [IncidentAsssignApiController::class, 'update']);

});