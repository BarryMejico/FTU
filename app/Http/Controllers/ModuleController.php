<?php
namespace App\Http\Controllers;
use App\Models\module;
use Illuminate\Http\Request;
class ModuleController extends Controller
{
    // Get all modules
    public function getModules()
    {
        return module::all();
    }

    // Create a new module
    public function createModule(Request $request)
    {
        $module = new module();

        $module->Module_Name = $request->Module_Name;
        $module->Module_Description ="This is a sample module description"; 
            // $request->Module_Description;
        $module->Module_percentage ="50" ;
            // $request->Module_percentage;
        $module->Module_nr_hrs ="1" ;
            // $request->Module_nr_hrs;
           
        $module->save();

        return response()->json(['message' => 'Module created successfully', 'module' => $module], 201);
    }

    // Update an existing module
    public function updateModule(Request $request, $id)
    {
        $module = module::find($id);
        $module->Module_Name = $request->Module_Name;
        $module->Module_Description = $request->Module_Description;
        $module->Course_ID = $request->Course_ID;
        $module->save();

        return response()->json(['message' => 'Module updated successfully', 'module' => $module], 200);
    }

    // Delete a module
    public function deleteModule($id)
    {
        $module = module::find($id);
        $module->delete();

        return response()->json(['message' => 'Module deleted successfully'], 200);
    }

    // Get a specific module
    public function getModule($id)
    {
        return module::find($id);
    }
}
?>