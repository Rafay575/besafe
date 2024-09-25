<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['grades'] = Grade::get();
        return view('grades.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        return view('grades.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGradeRequest $request)
    {
        $input = $request->all();
        Grade::create($input);
        return redirect()->route('grades.index')->with('success', 'Create successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        $data = [];
        $data['grade'] = $grade;
        return view('grades.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGradeRequest $request, Grade $grade)
    {
        $input = $request->all();
        $grade->fill($input);
        $grade->save();
        return redirect()->route('grades.index')->with('success', 'Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        if ($grade->delete()) {
            return redirect()->route('grades.index')->with('success', 'Delete successfully!');
        } else {
            return redirect()->route('grades.index')->with('error', 'Something went wrong!');
        }
    }
}
