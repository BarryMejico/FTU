<?php

namespace App\Http\Controllers;
use app\Helper\Ucode;
use App\Models\course;
use Illuminate\Http\Request;

class CourseController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(course $course)
    {
        //
    }
    public function getCourses()
    {
        return course::all();
    }

    public function createCourse(Request $request)
    {
        $course = new course;
        $course->Course_Name = $request->name;
        $course->Course_Description = $request->description;
        $course->Course_Code = Ucode();
        $course->Course_Duration = 1;
        $course->Course_Level = 1;
        $course->Course_Type = 1;
        $course->save();
        return response()->json(['message' => 'Course created successfully']);
    }

    public function updateCourse(Request $request, $id)
    {
        $course = course::find($id);
        $course->Course_Name = $request->name;
        $course->Course_Description = $request->description;
        $course->Course_Duration = 1;
        $course->Course_Level = 1;
        $course->Course_Type = 1;
        $course->save();
        return response()->json(['message' => 'Course updated successfully']);
    }

    public function deleteCourse($id)
    {
        $course = course::find($id);
        // dd($course);
        $course->delete();
        return response()->json(['message' => 'Course deleted successfully']);
    }

    public function getCourse($id)
    {
        return course::find($id);
    }
}
