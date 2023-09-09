<?php

namespace App\Http\Controllers;

use App\Models\Awol;
use App\Models\AwolStatusProcess;
use App\Models\InspectingOffice;
use App\Models\Unit;
use Illuminate\Http\Request;

class AwolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return inertia('Awol/Index', [
            "page_name" => 'AWOL',
            "awols" => Awol::with([
                'awol_action_history' => fn($query) => $query->recentHistory(),
                'awol_status_history' => fn($query) => $query->with(['awol_process'])->recentHistory(),
                'inspecting_office',
                'unit'
            ])->latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia("Awol/Create", [
            'page_name' => "AWOL",
            "inspecting_offices" => InspectingOffice::get(),
            "units" => Unit::get(),
            "awol_status_processes" => AwolStatusProcess::get()
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
            "date" => "required|date",
            "effectivity_date" => "required|date",
            "fullname" => "required|string",
            "remarks" => "required|string",
            "status" => "required|integer",
            "action_taken" => "required|string",
            "order_number" => "required|string",
        ]);

        $awol = $request->user()->awol()->create([
            "inspecting_office_id" => $validate["inspecting_office_id"],
            "unit_id" => $validate["unit_id"],
            "date" => $validate["date"],
            "effectivity_date" => $validate["effectivity_date"],
            "fullname" => $validate["fullname"],
            "remarks" => $validate["remarks"],
            "order_number" => $validate["order_number"],
        ]);

        $request->user()->awol_status_history()->create([
            'awol_process_id' => $validate['status'],
            'awol_id' => $awol->id
        ]);

        $request->user()->awol_action_history()->create([
            'description' => $validate['action_taken'],
            'awol_id' => $awol->id
        ]);

        return back()->with('success', 'Record Saved!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Awol $awol)
    {
        return inertia('Awol/Show', [
            'awol' => $awol->load([
                'awol_action_history' => fn($query) => $query->recentHistory(),
                'awol_status_history' => fn($query) => $query->with(['awol_process'])->recentHistory(),
                'inspecting_office',
                'unit'
            ]),
            'page_name' => "AWOL",
            "inspecting_offices" => InspectingOffice::get(),
            "units" => Unit::get(),
            "awol_status_processes" => AwolStatusProcess::get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Awol $awol)
    {
        return inertia('Awol/Edit', [
            'awol' => $awol->load([
                'awol_action_history' => fn($query) => $query->recentHistory(),
                'awol_status_history' => fn($query) => $query->with(['awol_process'])->recentHistory(),
                'inspecting_office',
                'unit'
            ]),
            'page_name' => "AWOL",
            "inspecting_offices" => InspectingOffice::get(),
            "units" => Unit::get(),
            "awol_status_processes" => AwolStatusProcess::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Awol $awol)
    {
        $awol_recent_status_history = $awol->awol_status_history()->latest()->limit(1)->get();
        $awol_recent_action_history = $awol->awol_action_history()->latest()->limit(1)->get();

        // dd($awol_recent_status_history[0]->awol_process_id);
        $validate = $request->validate([
            "inspecting_office_id" => "int|required",
            "unit_id" => "int|required",
            "date" => "required|date",
            "effectivity_date" => "required|date",
            "fullname" => "required|string",
            "remarks" => "required|string",
            "status" => "required|integer",
            "action_taken" => "required|string",
            "order_number" => "required|string",
        ]);

        $awol->update([
            "inspecting_office_id" => $validate["inspecting_office_id"],
            "unit_id" => $validate["unit_id"],
            "date" => $validate["date"],
            "effectivity_date" => $validate["effectivity_date"],
            "fullname" => $validate["fullname"],
            "remarks" => $validate["remarks"],
            "order_number" => $validate["order_number"],
        ]);


        if($validate['status'] != $awol_recent_status_history[0]->awol_process_id){
            $awol->awol_status_history()->create([
                'awol_process_id' => $validate['status'],
                'awol_id' => $awol->id,
                'by_user_id' => $request->user()->id
            ]);
        }
        
        if($validate['action_taken'] != $awol_recent_action_history[0]->description){
            $awol->awol_action_history()->create([
                'description' => $validate['action_taken'],
                'awol_id' => $awol->id,
                'by_user_id' => $request->user()->id
            ]);
        }

        return back()->with('success', 'Record Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Awol $awol)
    {
        if($awol->awol_action_history()->exists()){
            $awol->awol_action_history()->delete();
        }
        if($awol->awol_status_history()->exists()){
            $awol->awol_status_history()->delete();
        }

        $awol->delete();

        return back()->with('success', 'Record successfully deleted.');
    }
}
