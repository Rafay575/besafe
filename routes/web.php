<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BarChartController;
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
///////////////////////////////////////////////////////////////////////////
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\CronJobController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\TicketTypeController;
use App\Http\Controllers\TicketSubTypeController;
use App\Http\Controllers\TicketSettingController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\BusinessHoursController;
use App\Http\Controllers\SlaPolicyController;

///////////////////////////////////////////////////////////////////////////
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
// Route::get('/', function () {
//     return view('welcome');
// });


// Route::redirect('/dashboard', '/users');
// Route::redirect('/', '/dashboard');

Route::middleware('auth')->group(function () {

    Route::resource('slapolicies', SlaPolicyController::class);
    Route::resource('businesshours', BusinessHoursController::class);
    Route::resource('designations', DesignationController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('grades', GradeController::class);
    Route::resource('regions', RegionController::class);
    Route::resource('tickettypes', TicketTypeController::class);
    Route::resource('ticketsubtypes', TicketSubTypeController::class);
    Route::resource('ticketsetting', TicketSettingController::class);
    Route::resource('employees', EmployeesController::class);
    Route::resource('tickets', TicketsController::class);
    Route::get('tickets_assign', [TicketsController::class, 'tickets_assign'])->name('tickets.assign');
    Route::get('tickets_reassign/{id}', [TicketsController::class, 'tickets_reassign'])->name('tickets.reassign');
    Route::post('tickets_assignto', [TicketsController::class, 'tickets_assignto'])->name('tickets.assignto');
    Route::get('tickets_view/{id}', [TicketsController::class, 'tickets_view'])->name('ticket.view');
    Route::get('tickets_feedback/{id}', [TicketsController::class, 'tickets_feedback'])->name('ticket.feedback');
    Route::post('feedback_add', [TicketsController::class, 'feedback_add'])->name('feedback.add');
    Route::get('ticket/attachment/download/{id}', [TicketsController::class, 'ticket_attachment_download'])->name('ticket.attachment.download');
    Route::post('comment/add', [TicketsController::class, 'comment_add'])->name('comment.add');
    Route::get('comment/attachment/download/{id}', [TicketsController::class, 'comment_attachment_download'])->name('comment.attachment.download');
    Route::get('comment/attachment/view/{id}', [TicketsController::class, 'comment_attachment_view'])->name('comment.attachment.view');
    Route::post('ticket/close/{id}', [TicketsController::class, 'ticket_close'])->name('ticket.close');
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('users/profile/{user_id}', [UserController::class, 'profife_view'])->name('users.view');
    Route::get('line_chart', [LineChartController::class, 'index']);
    Route::get('card_chart', [CardChartController::class, 'index']);
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('users/profile', [UserController::class, 'profileCreate'])->name('users.profileCreate');
    Route::put('users/profile', [UserController::class, 'profileStore'])->name('users.profileStore');
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
    Route::get('pdfreports/metadata', [ReportController::class, 'metadata'])->name('pdfreports.metadata');
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


    // charts
    Route::get('/card_chart/all_timelines', [CardChartController::class, 'prepareForPiChart'])->name('pi_chart');
    Route::get('/bar_chart/all_timelines', [BarChartController::class, 'prepareForBarChart'])->name('bar_chart');
    Route::get('/line_chart/all_timelines', [LineChartController::class, 'prepareForLineChart'])->name('line_chart');

});

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/ticket/escalation/level', [CronJobController::class, 'ticket_escalation_level'])->name('ticket.escalation.level');

require __DIR__ . '/auth.php';