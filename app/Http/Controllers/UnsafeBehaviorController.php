<?php

namespace App\Http\Controllers;

use App\Models\UnsafeBehavior;
use Illuminate\Http\Request;

class UnsafeBehaviorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('unsafe-behavior.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('unsafe-behavior.create');
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
    public function show(UnsafeBehavior $unsafeBehavior)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UnsafeBehavior $unsafeBehavior)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UnsafeBehavior $unsafeBehavior)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UnsafeBehavior $unsafeBehavior)
    {
        //
    }
}
