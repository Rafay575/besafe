<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponseController;
use App\Http\Resources\ReportCollection;
use App\Models\FirePropertyDamage;
use App\Models\Hazard;
use App\Models\Injury;
use App\Models\InternalExternalAuditClause;
use App\Models\NearMiss;
use App\Models\PermitToWork;
use App\Models\Report;
use App\Models\UnsafeBehavior;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ReportController extends Controller
{

    public function index(Request $request, $channel = "web")
    {

        $limit = 10;
        if ($request->has('limit') && $request->limit != "") {
            $limit = $request->limit;
        }
        if ($request->has('report_of') && $request->report_of != "") {
            $reports = Report::where('report_of', $request->report_of)->latest()->paginate($limit);
            if ($reports) {
                return ReportCollection::collection($reports);
            }
            return ApiResponseController::error('No data returned', 404);

        } else {
            return ApiResponseController::error('Please provide valid report_of');
        }

    }

    public function createReport(Request $request, $channel = "web")
    {
        $filters = $request->except('report_of', 'to_date', 'from_date');
        if ($request->has('report_of') && $request->report_of != "") {
            $model = $this->getIncidentModelViaKeys($request->report_of);
            if ($model) {
                $data = $model::query();
                if ($request->has('from_date') && $request->has('to_date')) {
                    $data = $data->whereBetween('created_at', [$request->from_date, $request->to_date]);
                }

                // filters
                if (!empty($filters)) {
                    foreach ($filters as $filter_key => $filter_value) {
                        // checking if filter is availble
                        $filterExist = $this->availbleFilters($filter_key, $request->report_of);
                        if ($filterExist) {
                            $data = $data->where($filter_key, $filter_value);
                        }
                    }
                }

                // gettting final data
                $data = $data->get();
                if ($data) {
                    $report = $this->generatePdfReport($request, $data);
                    return ApiResponseController::successWithData('Report has been generated', new ReportCollection($report));
                }
                return ApiResponseController::error('No data returned', 404);

            } else {
                return ApiResponseController::error('Please provide valid report_of');
            }
        }
    }


    public function getIncidentModelViaKeys($key)
    {
        $keys = [
            'hazards' => Hazard::class,
            'near_misses' => NearMiss::class,
            'unsafe_behaviors' => UnsafeBehavior::class,
            'injuries' => Injury::class,
            'fpdamages' => FirePropertyDamage::class,
            'ptws' => PermitToWork::class,
            'ie_audits' => InternalExternalAuditClause::class,
        ];

        return $keys[$key];
    }

    public function availbleFilters($filter_name, $model_key)
    {
        $keys = [
            'hazards' => ['meta_incident_status_id', 'meta_department_id', 'meta_line_id', 'meta_unit_id', 'initiated_by'],
            'near_misses' => ['meta_incident_status_id', 'initiated_by'],
            'unsafe_behaviors' => ['meta_incident_status_id', 'initiated_by', 'meta_department_id', 'meta_line_id', 'meta_unit_id'],
            'injuries' => ['meta_incident_status_id', 'initiated_by', 'meta_injury_category_id', 'meta_incident_category_id'],
            'fpdamages' => ['meta_incident_status_id', 'initiated_by', 'meta_fire_category_id', 'meta_unit_id', 'meta_property_damage_id'],
            'ptws' => ['initiated_by', 'meta_ptw_type_id', 'meta_ptw_item_id'],
            'ie_audits' => ['initiated_by', 'meta_audit_type_id', 'meta_audit_hall_id'],
        ];


        return array_key_exists($filter_name, $keys[$model_key]);
        // return $keys[$model_key][$filter_name];
    }

    public function generatePdfReport($request, $data)
    {
        $now = Carbon::now();
        $file_name = $request->report_of . '_' . $now;
        if ($request->has('from_date') && $request->has('to_date')) {
            $file_name = $request->report_of . '_' . $request->from_date . "_to_" . $request->to_date;
        }
        $file_name = $file_name . $now->getTimestamp();
        $file_name = \Str::slug($file_name) . ".pdf";
        $view = $this->getViewForReport($request->report_of);
        try {
            $file = \PDF::loadView($view, ['data' => $data])->setPaper('a4');

            $file->save(public_path('reports/' . $file_name));
            return $this->saveReport($request, $file_name);
        } catch (\Exception $e) {
            return $e->getMessage();
        }


    }

    public function saveReport($request, $file_name)
    {
        $report = new Report();
        // $report->user_id = auth()->user()->id;
        $report->report_of = $request->report_of;
        $report->file_path = 'reports';
        $report->file_name = $file_name;
        $report->from_date = $request->from_date;
        $report->to_date = $request->to_date;
        $report->save();

        return $report;
    }


    public function getViewForReport($model_key)
    {


        $keys = [
            'hazards' => 'pdf.hazards_list',
            'near_misses' => 'pdf.near_misses_list',
            'unsafe_behaviors' => 'pdf.unsafe_behaviors_list',
            'injuries' => 'pdf.injuries_list',
            'fpdamages' => 'pdf.fpdamages_list',
            'ptws' => 'pdf.ptws_list',
            'ie_audits' => 'pdf.ie_audits_list',
        ];

        return $keys[$model_key];
    }


    public function destroy($report_id, $channel = 'web')
    {
        // RolesPermissionController::can(['report.delete']);

        $report = Report::find($report_id);
        if (!$report && $channel === "api") {
            return ApiResponseController::error('report not found', 404);
        }

        if (!$report) {
            return ['error', 'report not found'];
        }

        // deleting the report
        if (
            File::delete(public_path('reports/' . $report->file_name)) &&
            $report->delete()
        ) {
            if ($channel === 'api') {
                return ApiResponseController::success('report has been delete');
            } else {
                return ['deleted', 'report has been deleted'];
            }
        } else {
            if ($channel === 'api') {
                return ApiResponseController::error('Could not delete the report.');
            } else {
                return ['error', 'Could not delete the report'];
            }
        }
    }
}