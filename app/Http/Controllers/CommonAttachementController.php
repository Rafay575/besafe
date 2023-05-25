<?php

namespace App\Http\Controllers;

use App\Models\CommonAttachement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CommonAttachementController extends Controller
{
    public function uploadedArray($filesArray, $model, $inputName)
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
    public function syncUploadedArray($filesArray, $model, $inputName)
    {
        // delete all previous files
        // if ($model->$inputName) {
        //     foreach ($model->$inputName as $file) {
        //         $this->destroy($file->id);
        //     }
        // }
        if (!empty($filesArray)) {
            $tableName = $model->getTable();
            foreach ($filesArray as $file) {
                $originalFileName = $file->getClientOriginalName(); // Get the original file name
                // Generate a unique file name based on the original file name and current time
                $fileName = pathinfo($originalFileName, PATHINFO_FILENAME);
                $file_name = $fileName . '_' . time() . '.' . $file->getClientOriginalExtension();
                $upload_path = public_path("attachements/{$tableName}/{$inputName}/");
                $file->move($upload_path, $file_name);
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

    public function destroy($file_id, $channel = "web")
    {
        $commonFile = CommonAttachement::where('id', $file_id)->first();
        $form_name = $commonFile->form_name;
        $form_input_name = $commonFile->form_input_name;
        $file_path = public_path("attachements/{$form_name}/{$form_input_name}/" . $commonFile->file_name);
        if ($commonFile->delete()) {
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