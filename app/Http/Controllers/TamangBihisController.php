<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Models\InspectingOffice;
use App\Models\TamangBihis;
use App\Models\TamangBihisInfraction;
use App\Models\TamangBihisViolation;
use Illuminate\Support\Facades\DB;

class TamangBihisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('TamangBihis/Index', [
            'tamang_bihis' => TamangBihis::with(['infraction' => function($query) {
                $query->with(['violation' => function($query) { $query->select(['name', 'id']); }]);
            }, 'unit', 'inspecting_office'])->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('TamangBihis/Create', [
            "inspecting_offices" => InspectingOffice::get(),
            "units" => Unit::get(),
            "violations" => TamangBihisViolation::orderBy('name', 'asc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        // dd($request->input('infractions'));
        $validatedData = $request->validate([
            "inspecting_office_id" => "int|required",
            "fullname" => "string|required",
            "date_time" => "required",
            "unit_id" => "int|required",
            "infractions" => "array|required",
            "status" => "string"
        ]);

        $tamang_bihis = $request->user()->tamang_bihis()->create([
            "inspecting_office_id" => $validatedData['inspecting_office_id'],
            "fullname" => $validatedData['fullname'],
            "date_time" => $validatedData['date_time'],
            "unit_id" => $validatedData['unit_id'],
            "status" => $validatedData['status']
        ]);

        foreach($validatedData['infractions'] as $infraction){
            TamangBihisInfraction::create([
                "tamang_bihis_id" => $tamang_bihis->id,
                "tamang_bihis_violation_id" => $infraction['id'],
                "other_infraction" => $infraction['other_infraction']
            ]);
        }

        return back()->with('success', 'Record Added!');

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
    public function edit(TamangBihis $tamang_bihis)
    {
        // $data = $tamang_bihis->with(['infraction' => function($query) {
        //     $query->with('violation');
        // }])->get();
        $infraction = $tamang_bihis->load('infraction');
        $violation = $infraction->infraction->load('violation');

        return inertia('TamangBihis/Edit', [
            "inspecting_offices" => InspectingOffice::get(),
            "units" => Unit::get(),
            "violations" => TamangBihisViolation::orderBy('name', 'asc')->get(),
            "tamang_bihis" => $tamang_bihis,
            "infraction" => $violation
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TamangBihis $tamang_bihis)
    {
        $validatedData = $request->validate([
            "inspecting_office_id" => "int|required",
            "fullname" => "string|required",
            "date_time" => "required",
            "unit_id" => "int|required",
            "infractions" => "array|required",
            "status" => "string"
        ]);
        $tamang_bihis_udpated = $tamang_bihis->update([
            "inspecting_office_id" => $validatedData['inspecting_office_id'],
            "fullname" => $validatedData['fullname'],
            "date_time" => $validatedData['date_time'],
            "unit_id" => $validatedData['unit_id'],
            "status" => $validatedData['status']
        ]);

        TamangBihisInfraction::whereIn("tamang_bihis_id", [$tamang_bihis->id])->delete();
        
        foreach($validatedData['infractions'] as $infraction){
            
            TamangBihisInfraction::create([
                "tamang_bihis_id" => $tamang_bihis->id,
                "tamang_bihis_violation_id" => $infraction['id'],
                "other_infraction" => $infraction['other_infraction']
            ]);
        }

        return redirect()->back()->with('success', 'Record Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TamangBihis $tamang_bihis)
    {
        $tamang_bihis->infraction()->delete();
        $tamang_bihis->delete();

        return back()->with('success', 'Record Deleted!');
    }
}
