<?php

namespace App\Http\Controllers;

use App\Models\InspectingOffice;
use App\Models\Unit;
use App\Models\UnitInfraction;
use Illuminate\Http\Request;

class UnitInfractionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('UnitInfraction/Index', [
            'data' => UnitInfraction::with(['inspecting_office', 'unit'])->latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('UnitInfraction/Create', [
            "inspecting_offices" => InspectingOffice::get(),
            "units" => Unit::get(),
            "page_name" => 'Unit Infraction'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            "inspecting_office_id" => "int|required",
            "unit_id" => "int|required",
            "date_time" => "required",
            "fullname" => "string|required",
            "infractions_noted" => "string|required",
            "status" => "string",
        ]);

        $request->user()->unit_infractions()->create($validate);

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
    public function edit(UnitInfraction $unit_infraction)
    {
        return inertia('UnitInfraction/Edit', [
            "inspecting_offices" => InspectingOffice::get(),
            "units" => Unit::get(),
            "unit_infraction" => $unit_infraction,
            "page_name" => 'Unit Infraction'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UnitInfraction $unit_infraction)
    {
        $unit_infraction->update(
            $request->validate([
                "inspecting_office_id" => "int|required",
                "unit_id" => "int|required",
                "date_time" => "required",
                "fullname" => "string|required",
                "infractions_noted" => "string|required",
                "status" => "string",
            ])
        );

        return redirect()->route('unit_infraction.index')
        ->with('success', 'Record Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UnitInfraction $unit_infraction)
    {
        $unit_infraction->delete();

        return back()->with('success', 'Record Deleted!');
    }
}
