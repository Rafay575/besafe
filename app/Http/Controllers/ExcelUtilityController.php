<?php

namespace App\Http\Controllers;

use App\Imports\MetaDataExcelImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ExcelUtilityController extends Controller
{
    public function importMetaData(Request $request, $channel = "web")
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,csv',
        ]);


        $formErrorsResponse = FormValidatitionDispatcherController::Response($validator, $channel);
        if ($formErrorsResponse) {
            return $formErrorsResponse;
        }

        try {
            Excel::import(new MetaDataExcelImport, $request->file);
            return ['success', 'Meta Data has been imported', $request->redirect];
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $errorMsgs = [];
            $failures = $e->failures();
            foreach ($failures as $failure) {
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $errorMsgs[] = $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
            }

            return ['error', $errorMsgs];

        }


    }
}