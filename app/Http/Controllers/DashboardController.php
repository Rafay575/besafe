<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ReportApiController;
use App\Http\Resources\IEAuditAnswersAttachementsCollection;
use App\Http\Resources\IEAuditAnswersCollection;
use App\Http\Resources\IncidentCollection;
use App\Models\FirePropertyDamage;
use App\Models\Hazard;
use App\Models\Injury;
use App\Models\InternalExternalAuditAnswer;
use App\Models\InternalExternalAuditClause;
use App\Models\NearMiss;
use App\Models\UnsafeBehavior;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $now = Carbon::now();
        $file_name = $request->report_of . '_' . $now;
        $file_name = $file_name . $now->getTimestamp();
        $file_name = \Str::slug($file_name) . ".pdf";
        $data = Hazard::all();
        $file = \PDF::loadView('pdf.hazards_list', ['data' => $data])->setPaper('a4');
        $file->save(public_path('reports/' . $file_name));
        return $file_name;
        return view('dashboard');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}