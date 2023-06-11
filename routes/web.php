<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CardChartController;
use App\Http\Controllers\CommonAttachementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExcelUtilityController;
use App\Http\Controllers\FirePropertyDamageController;
use App\Http\Controllers\HazardController;
use App\Http\Controllers\IEAuditBulkResponseController;
use App\Http\Controllers\IncidentAssignController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\InjuryController;
use App\Http\Controllers\InternalExternalAuditAnswerAttachementController;
use App\Http\Controllers\InternalExternalAuditAnswerController;
use App\Http\Controllers\InternalExternalAuditClauseController;
use App\Http\Controllers\LineChartController;
use App\Http\Controllers\MetaDataController;
use App\Http\Controllers\NearMissController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PermitToWorkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
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
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('unsafe-behaviors', UnsafeBehaviorController::class);
    Route::resource('near-miss', NearMissController::class);
    Route::resource('profile', ProfileController::class);
    Route::resource('hazards', HazardController::class);
    Route::resource('fire-property', FirePropertyDamageController::class);
    Route::resource('injuries', InjuryController::class);
    Route::resource('ptws', PermitToWorkController::class);
    Route::resource('ie_audits', InternalExternalAuditClauseController::class);
    Route::resource('audit_init', IEAuditBulkResponseController::class);
    Route::resource('roles', RolesPermissionController::class);
    Route::resource('pdfreports', ReportController::class);

    // about
    // about company
    Route::get('company/about', [AboutController::class, 'show'])->name('about.show');
    Route::put('company/about', [AboutController::class, 'update'])->name('about.update');

    // Route::resource('meta-data', MetaDataController::class);
    Route::get('meta-data', [MetaDataController::class, 'index'])->name('meta-data.index');
    Route::get('meta-data/{meta_data_id}/{meta_data_name}/edit', [MetaDataController::class, 'edit'])->name('meta-data.edit');
    Route::get('meta-data/{meta_data_name}/create', [MetaDataController::class, 'create'])->name('meta-data.create');
    Route::post("meta-data", [MetaDataController::class, 'store'])->name('meta-data.store');
    Route::delete('meta-data/{meta_data_id}/{meta_data_name}/destroy', [MetaDataController::class, 'destroy'])->name('meta-data.destroy');

    Route::delete('common_files/{file_id}/delete', [CommonAttachementController::class, 'destroy'])->name('common_files.destroy');
    Route::delete('ie_audit_ans_file/{file_id}/delete', [InternalExternalAuditAnswerAttachementController::class, 'destroy'])->name('ie_audit_ans_file.destroy');
    Route::get('incidents', [IncidentController::class, 'index'])->name('incidents.index');
    Route::get('department_users', [UserController::class, 'departmentUsers'])->name('users.department_users');
    Route::post('storeByIncidentName', [IncidentAssignController::class, 'storeByIncidentName'])->name('incidents.storeByIncidentName');
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('notifications', [NotificationController::class, 'activitySeen'])->name('notifications.activitySeen');


    // excel utilities
    // meta data excel import
    Route::post('meta-data/excel/import', [ExcelUtilityController::class, 'importMetaData'])->name('meta-data.excel.import');


});

require __DIR__ . '/auth.php';