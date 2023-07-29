<?php

namespace App\Http\Controllers;

use App\Models\CovidInfraction;
use App\Models\InspectingOffice;
use App\Models\Unit;
use Illuminate\Http\Request;

class CovidInfractionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('CovidInfraction/Index', [
            'data' => CovidInfraction::with(['inspecting_office', 'unit'])->latest()->paginate(10),
            'page_name' => 'Covid 19 Infractions'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('CovidInfraction/Create', [
            "inspecting_offices" => InspectingOffice::get(),
            "units" => Unit::get(),
            "page_name" => 'Covid Infraction'
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

        $request->user()->covid_infraction()->create($validate);

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
    public function destroy(CovidInfraction $covid_infraction)
    {
        $covid_infraction->delete();

        return redirect()->back()->with('success', 'Entry deleted successfully!');
    }
}
