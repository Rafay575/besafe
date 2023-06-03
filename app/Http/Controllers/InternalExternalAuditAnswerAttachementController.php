<?php

namespace App\Http\Controllers;

use App\Models\InternalExternalAuditAnswerAttachement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class InternalExternalAuditAnswerAttachementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(InternalExternalAuditAnswerAttachement $internalExternalAuditAnswerAttachement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InternalExternalAuditAnswerAttachement $internalExternalAuditAnswerAttachement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InternalExternalAuditAnswerAttachement $internalExternalAuditAnswerAttachement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($file_id, $channel = "web")
    {
        $audit_ans_file = InternalExternalAuditAnswerAttachement::where('id', $file_id)->first();
        if (!$audit_ans_file) {
            return ['File not found'];
        }
        $file_path = public_path("attachements/ie_audit/" . $audit_ans_file->file_name);
        if ($audit_ans_file->delete()) {
            File::delete($file_path);
            if ($channel == "web") {
                return ['deleted', 'File has been deleted'];
            }
            return true;
        }
        if ($channel == "web") {
            return ['deleted', 'Could not delete the file'];
        }
        return false;
    }
}