<?php
namespace App\Http\Controllers;
use App\Models\subject;
use Illuminate\Http\Request;
class SubjectController extends Controller
{
    // Get all subjects
    public function getSubjects()
    {
        return subject::all();
    }

    // Create a new subject
    public function createSubject(Request $request)
    {
        $subject = new subject();

        $subject->Subject_Name = $request->Subject_Name;
        $subject->Subject_Description = $request->Subject_Description;
        $subject->Subject_Credit = $request->Subject_Credit;
        $subject->Subject_Code = $request->Subject_Code;
        $subject->Subject_percentage = $request->Subject_percentage;
        $subject->Subject_Type = $request->Subject_Type;
        $subject->Subject_Code = $request->Subject_Code;
           
        $subject->save();

        return response()->json(['message' => 'Subject created successfully', 'subject' => $subject], 201);
    }

    // Update an existing subject
    public function updateSubject(Request $request, $id)
    {
        $subject = subject::find($id);
        $subject->Subject_Name = $request->Subject_Name;
        $subject->Subject_Description = $request->Subject_Description;
        $subject->save();

        return response()->json(['message' => 'Subject updated successfully', 'subject' => $subject], 200);
    }

    // Delete a subject
    public function deleteSubject($id)
    {
        $subject = subject::find($id);
        $subject->delete();

        return response()->json(['message' => 'Subject deleted successfully'], 200);
    }

    // Get a specific subject
    public function getSubject($id)
    {
        return subject::find($id);
    }
}
?>