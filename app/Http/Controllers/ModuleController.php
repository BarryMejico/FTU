<?php

namespace App\Http\Controllers;

use App\Models\module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules = Module::all();
        return view('modules.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(request $request)
    {
        $validatedData = $request->
                validate([
            'Module_Name' => 'required|string|max:255',
            'Module_Description' => 'required|string',
            'Module_percentage' => 'required|numeric|min:0|max:100',
            'Module_nr_hrs' => 'required|integer|min:0',
        ]);

        Module::create($validatedData);
        return redirect()->route('modules.index')->with('success', 'Module created successfully.');
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
    public function show(module $module)
    {
         $inputs = request()->all();
        $module->update($inputs);
        return redirect()->route('modules.index')->with('success', 'Module updated successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(module $module)
    {
        $inputs = request()->all();
        $module->update($inputs);
        return redirect()->route('modules.index')->with('success', 'Module updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, module $module)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(module $module)
    {
        //
    }
}
