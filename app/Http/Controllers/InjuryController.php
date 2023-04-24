<?php

namespace App\Http\Controllers;

use App\Models\Injury;
use Illuminate\Http\Request;

class InjuryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('injuries.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('injuries.create');
        
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
    public function show(Injury $injury)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Injury $injury)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Injury $injury)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Injury $injury)
    {
        //
    }
}
