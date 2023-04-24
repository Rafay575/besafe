<?php

namespace App\Http\Controllers;

use App\Models\NearMiss;
use Illuminate\Http\Request;

class NearMissController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('near-miss.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('near-miss.create');
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
    public function show(NearMiss $nearMiss)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NearMiss $nearMiss)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NearMiss $nearMiss)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NearMiss $nearMiss)
    {
        //
    }
}
