<?php

namespace App\Http\Controllers;

use App\Models\teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function save_data(Request $request)
    {
        // Validate the request data
        $request->validate([
            'user_id' => 'required|unique:teachers|exists:users,id',
            'rank' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'age' => 'nullable|integer',
            'contact_number' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255'
        ]);
       
            // Create a new teacher record
        $teacher = teacher::create([
            'user_id' => $request->user_id,
            'rank' => $request->rank,
            'birthday' => $request->birthday,
            'age' => $request->age,
            'contact_number' => $request->contact_number,
            'address' => $request->address]);

        // Return a response
        return response()->json(['message' => 'Teacher created successfully', 'teacher' => $teacher], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(teacher $teacher)
    {
        //
    }
}
