<?php

namespace App\Http\Controllers;

use App\Models\InspectingOffice;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProActive extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('ProActive/Index', []);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('ProActive/Create', [
            "inspecting_offices" => InspectingOffice::get(),
            "units" => Unit::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $validate = $request->validate([
            "inspecting_office_id" => "int|required|max:255",
            "date_time" => "required",
            "unit_id" => "int|required",
            "street" => "string|required",
            "barangay" => "string|required",
            "municipality" => "string|required",
            "province" => "string|required",
            "region" => "string|required",
            "type" => "string|required",
            "special_category" => "string",
            "ap" => "integer|required|max:1040|min:1",
            "aa" => "integer|required|max:1040|min:1",
            "ua" => "integer|required|max:1040|min:1"
        ]);

        $request->user()->proactive()->create($validate);

        return redirect()->back()->with('success', 'Entry added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
