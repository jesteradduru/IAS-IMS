<?php

namespace App\Http\Controllers;

use App\Models\AbsentPersonnel;
use App\Models\InspectingOffice;
use App\Models\Unit;
use Illuminate\Http\Request;

class AbsentPersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('AbsentPersonnel/Index', [
            'data' => AbsentPersonnel::with(['inspecting_office', 'unit'])->latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('AbsentPersonnel/Create', [
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
            "inspecting_office_id" => "int|required",
            "unit_id" => "int|required",
            "date_time" => "required",
            "fullname" => "string|required",
            "action_taken" => "string|required",
            "status" => "string",
        ]);

        $request->user()->absent_personnel()->create($validate);

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
    public function edit(AbsentPersonnel $absent_personnel)
    {
        return inertia('AbsentPersonnel/Edit', [
            'data' => $absent_personnel,
            "inspecting_offices" => InspectingOffice::get(),
            "units" => Unit::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AbsentPersonnel $absent_personnel)
    {
        $absent_personnel->update(
            $request->validate([
                "inspecting_office_id" => "int|required",
                "unit_id" => "int|required",
                "date_time" => "required",
                "fullname" => "string|required",
                "action_taken" => "string|required",
                "status" => "string",
            ])
        );

        return redirect()->route('absent_personnel.index')
        ->with('success', 'Record Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AbsentPersonnel $absent_personnel)
    {
        $absent_personnel->delete();

        return back()->with('success', 'Record Deleted!');
    }
}
