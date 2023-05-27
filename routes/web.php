<?php

use App\Http\Controllers\CardChartController;
use App\Http\Controllers\CommonAttachementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FirePropertyDamageController;
use App\Http\Controllers\HazardController;
use App\Http\Controllers\IncidentAssignController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\InjuryController;
use App\Http\Controllers\InternalExternalAuditClauseController;
use App\Http\Controllers\LineChartController;
use App\Http\Controllers\MetaDataController;
use App\Http\Controllers\NearMissController;
use App\Http\Controllers\PermitToWorkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesPermissionController;
use App\Http\Controllers\UnsafeBehaviorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});


// Route::redirect('/dashboard', '/users');
Route::redirect('/', '/dashboard');

Route::middleware('auth')->group(function () {
    Route::get('line_chart', [LineChartController::class, 'index']);
    Route::get('card_chart', [CardChartController::class, 'index']);
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::resource('users', UserController::class);
    Route::resource('meta-data', MetaDataController::class);
    Route::resource('unsafe-behaviors', UnsafeBehaviorController::class);
    Route::resource('near-miss', NearMissController::class);
    Route::resource('profile', ProfileController::class);
    Route::resource('hazards', HazardController::class);
    Route::resource('fire-property', FirePropertyDamageController::class);
    Route::resource('injuries', InjuryController::class);
    Route::resource('ptws', PermitToWorkController::class);
    Route::resource('ie_audits', InternalExternalAuditClauseController::class);
    Route::resource('roles', RolesPermissionController::class);
    Route::delete('common_files/{file_id}/delete', [CommonAttachementController::class, 'destroy'])->name('common_files.destroy');
    Route::get('incidents', [IncidentController::class, 'index'])->name('incidents.index');
    Route::get('department_users', [UserController::class, 'departmentUsers'])->name('users.department_users');
    Route::post('storeByIncidentName', [IncidentAssignController::class, 'storeByIncidentName'])->name('incidents.storeByIncidentName');
});

require __DIR__ . '/auth.php';