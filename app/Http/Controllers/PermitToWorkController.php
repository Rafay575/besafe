<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponseController;
use App\Http\Resources\PermitToWorkCollection;
use App\Models\PermitToWork;
use App\Rules\PtwActionData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Yajra\DataTables\DataTables;

class PermitToWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $channel = "web")
    {
        RolesPermissionController::can(['ptw.index']);
        $ptws = PermitToWork::where('initiated_by', auth()->user()->id);
        if (auth()->user()->can(['ptw.index', 'ptw.delete', 'ptw.edit'])) {
            $ptws = PermitToWork::orderby('id', 'desc');
        }

        if ($channel == "api") {
            return $ptws;
        }

        if ($request->ajax()) {
            $data = [];
            $i = 0;
            foreach ($ptws->get() as $ptw) {
                $i++;
                $data[] = [
                    'sno' => $i,
                    'start_time' => $ptw->start_time,
                    'end_time' => $ptw->end_time,
                    'work_area' => $ptw->work_area,
                    'moc_title' => $ptw->moc_title,
                    'worker_name' => $ptw->worker_name,
                    'action' => view('ptws.partials.action-buttons', ['ptw' => $ptw])->render()
                ];
            }

            return DataTables::of($data)->toJson();
        }
        return view('ptws.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        RolesPermissionController::can(['ptw.create']);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $channel = "web")
    {
        RolesPermissionController::can(['ptw.create']);

        $validator = $this->validateData($request);

        $formErrorsResponse = FormValidatitionDispatcherController::Response($validator, $channel);
        if ($formErrorsResponse) {
            return $formErrorsResponse;
        }

        $ptw = new PermitToWork();
        $ptw->date = $request->date;
        $ptw->initiated_by = auth()->user()->id;
        $ptw->start_time = $request->start_time;
        $ptw->end_time = $request->end_time;
        $ptw->work_area = $request->work_area;
        $ptw->line_machine = $request->line_machine;
        $ptw->is_ptw_exist = $request->is_ptw_exist;
        $ptw->cross_reference = $request->cross_reference;
        $ptw->moc_required = $request->moc_required;
        $ptw->moc_title = $request->moc_title;
        $ptw->moc_desc = $request->moc_desc;
        $ptw->working_group = $request->working_group;
        $ptw->worker_name = $request->worker_name;
        $ptw->immediate_cause = $request->immediate_cause;
        $ptw->root_cause = $request->root_cause;
        $ptw->actions = $request->actions;
        $ptw->meta_ptw_type_id = $request->meta_ptw_type_id;

        $ptw->save();
        // Synchronize the meta PTW items
        $ptw->ptw_items()->sync($request->meta_ptw_item_id);


        if ($channel === 'api') {
            return ApiResponseController::successWithData('PTW created.', new PermitToWorkCollection($ptw));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($ptw_id, $channel = "web")
    {
        RolesPermissionController::can(['ptw.view']);

        $ptw = PermitToWork::where('id', $ptw_id)->where('initiated_by', auth()->user()->id)->first();
        if (auth()->user()->can(['ptw.edit', 'ptw.create', 'ptw.delete'])) {
            $ptw = PermitToWork::where('id', $ptw_id)->first();
        }

        if (!$ptw && $channel === 'api') {
            return ApiResponseController::error('PTW not found', 404);
        }

        if ($channel === "api") {
            return $ptw;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PermitToWork $permitToWork)
    {
        RolesPermissionController::can(['ptw.edit']);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $ptw_id, $channel = "web")
    {
        RolesPermissionController::can(['ptw.edit']);

        $validator = $this->validateData($request);

        $formErrorsResponse = FormValidatitionDispatcherController::Response($validator, $channel);
        if ($formErrorsResponse) {
            return $formErrorsResponse;
        }

        $ptw = PermitToWork::where('id', $ptw_id)->where('initiated_by', auth()->user()->id)->first();
        if (auth()->user()->can(['ptw.edit', 'ptw.create', 'ptw.delete'])) {
            $ptw = PermitToWork::where('id', $ptw_id)->first();
        }

        if (!$ptw && $channel === 'api') {
            return ApiResponseController::error('PTW not found', 404);
        }

        $ptw->date = $request->date;
        $ptw->start_time = $request->start_time;
        $ptw->end_time = $request->end_time;
        $ptw->work_area = $request->work_area;
        $ptw->line_machine = $request->line_machine;
        $ptw->is_ptw_exist = $request->is_ptw_exist;
        $ptw->cross_reference = $request->cross_reference;
        $ptw->moc_required = $request->moc_required;
        $ptw->moc_title = $request->moc_title;
        $ptw->moc_desc = $request->moc_desc;
        $ptw->working_group = $request->working_group;
        $ptw->worker_name = $request->worker_name;
        $ptw->immediate_cause = $request->immediate_cause;
        $ptw->root_cause = $request->root_cause;
        $ptw->actions = $request->actions;
        $ptw->meta_ptw_type_id = $request->meta_ptw_type_id;
        $ptw->save();
        // Synchronize the meta PTW items
        $ptw->ptw_items()->sync($request->meta_ptw_item_id);


        if ($channel === 'api') {
            return ApiResponseController::successWithData('PTW updated.', new PermitToWorkCollection($ptw));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ptw_id, $channel = "web")
    {
        RolesPermissionController::can(['ptw.delete']);
        $ptw = PermitToWork::where('id', $ptw_id)->where('initiated_by', auth()->user()->id)->first();
        if (auth()->user()->can(['ptw.edit', 'ptw.create', 'ptw.delete'])) {
            $ptw = PermitToWork::where('id', $ptw_id)->first();
        }

        if (!$ptw && $channel === 'api') {
            return ApiResponseController::error('PTW not found', 404);
        }

        if (!$ptw) {
            return ['error', 'PTW not found'];
        }

        if ($ptw->delete()) {
            if ($channel === 'api') {
                return ApiResponseController::success('PTW has been delete');
            } else {
                return ['deleted', 'PTW has been deleted'];
            }
        } else {
            if ($channel === 'api') {
                return ApiResponseController::error('Could not delete the PTW.');
            } else {
                return ['error', 'Could not delete the PTW'];
            }
        }

    }

    public function validateData(Request $request)
    {
        return Validator::make($request->all(), [
            'date' => ['required', 'date', 'date_format:Y-m-d'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i'],
            'work_area' => ['required', 'string'],
            'line_machine' => ['nullable', 'string'],
            'is_ptw_exist' => ['required', 'boolean'],
            'cross_reference' => ['nullable', 'string'],
            'moc_required' => ['required', 'boolean'],
            'moc_title' => ['nullable', 'string'],
            'moc_desc' => ['nullable', 'string'],
            'meta_ptw_type_id' => ['required', 'exists:meta_ptw_types,id'],
            'working_group' => ['nullable', 'string'],
            'worker_name' => ['nullable', 'string'],
            'meta_ptw_item_id' => 'array',
            'meta_ptw_item_id.*' => 'exists:meta_ptw_items,id',
            'immediate_cause' => ['nullable', 'string'],
            'root_cause' => ['nullable', 'string'],
            'actions' => ['array', new PtwActionData],
        ]);
    }
}