<?php

namespace App\Http\Controllers;

use App\Models\FirePropertyDamage;
use Illuminate\Http\Request;

class FirePropertyDamageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('fire-property.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fire-property.create');
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
    public function show(FirePropertyDamage $firePropertyDamage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FirePropertyDamage $firePropertyDamage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FirePropertyDamage $firePropertyDamage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FirePropertyDamage $firePropertyDamage)
    {
        //
    }
}
