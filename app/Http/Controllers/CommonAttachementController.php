<?php

namespace App\Http\Controllers;

use App\Models\CommonAttachement;
use Illuminate\Http\Request;

class CommonAttachementController extends Controller
{
    public static function uploadedArray($filesArray, $model, $inputName)
    {
        if (!empty($filesArray)) {
            $tableName = $model->getTable();
            foreach ($filesArray as $file) {
                $file_name = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path("attachements/{$tableName}/{$inputName}/"), $file_name);
                $attachement = new CommonAttachement();
                $attachement->incident_id = $model->id;
                $attachement->form_name = $model->getTable();
                $attachement->form_input_name = $inputName;
                $attachement->file_name = $file_name;
                $attachement->user_id = auth()->user()->id;
                $attachement->save();
            }
        }

    }
}