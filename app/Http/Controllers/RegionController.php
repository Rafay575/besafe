<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Http\Requests\StoreRegionRequest;
use App\Http\Requests\UpdateRegionRequest;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['regions'] = Region::get();
        return view('regions.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        $data['regions'] = Region::get();
        return view('regions.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegionRequest $request)
    {
        $input = $request->all();
        Region::create($input);
        return redirect()->route('regions.index')->with('success', 'Create successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Region $region)
    {
        $data = [];
        $data['region']     = $region;
        $data['p_regions']  = Region::get();
        return view('regions.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegionRequest $request, Region $region)
    {
        $input = $request->all();
        $region->fill($input);
        $region->save();
        return redirect()->route('regions.index')->with('success', 'Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Region $region)
    {
        if ($region->delete()) {
            return redirect()->route('regions.index')->with('success', 'Delete successfully!');
        } else {
            return redirect()->route('regions.index')->with('error', 'Something went wrong!');
        }
    }
}
