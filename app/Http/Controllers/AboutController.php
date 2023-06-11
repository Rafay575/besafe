<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    public function show()
    {
        // RoleController::checkPermission(['about_company_index']);
        $about = About::first();
        return view('about.show', compact('about'));
    }

    public function update(Request $request)
    {
        // RoleController::checkPermission(['about_company_edit']);

        $about = About::first();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'detail' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'email',
            'mailing' => 'required',
            'website' => 'required',
            'fax' => 'required',
            // 'full_logo' => 'mimes:png|max:4096',
            // 'mini_logo' => 'mimes:png|max:4096',
            'full_logo' => 'image',
            'mini_logo' => 'image',
            // 'loader' => 'image',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return ['error', $error];
        }
        $about->name = $request->name;
        $about->description = $request->description;
        $about->detail = $request->detail;
        $about->address = $request->address;
        $about->phone = $request->phone;
        $about->email = $request->email;
        $about->mailing = $request->mailing;
        $about->website = $request->website;
        $about->fax = $request->fax;
        $about->save();

        if ($request->has('full_logo')) {
            $request->full_logo->move(public_path('website/img'), 'logo.png');
        }
        if ($request->has('mini_logo')) {
            $request->mini_logo->move(public_path('website/img'), 'logo-mini.png');
        }
        if ($request->has('loader')) {
            $request->loader->move(public_path('website/img'), 'loader.gif');
        }
        return ['success', 'Information has been updated!', $request->redirect];
    }
}