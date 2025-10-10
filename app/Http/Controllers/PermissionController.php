<?php

namespace App\Http\Controllers;

use App\Models\permission;
use App\Models\permission_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permission= DB::table('permissions')
        ->select('*')
        ->get();
        // dd($permission);
        return $permission;
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
    public function show(permission $permission)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(permission $permission)
    {
        //
    }

    public function menuFor(Request $request){
         $id=$request->all();
        // dd($id['id']);
        $Menu= DB::table('permission_details')
        ->join('menu', 'menu.id', '=', 'permission_details.id')
        ->where('permission_details.permiCode',$id['id'])
        ->select('menu.*')
        ->get();
        return $Menu;
    }

    public function specificmenu(Request $request){
        $id=$request->all();
        // dd($id['id']);
        $Menu= DB::table('permissions')
        ->join('permission_details', 'permission_details.permiCode', '=', 'permissions.permCode')
        ->where('permissions.permCode',$id['id'])
        ->select('permissions.*','permission_details.*')
        ->get();
        return $Menu;
    }

    public function updateBULK(Request $request){
        $recordsArray=$request->all();
        // dd($recordsArray['selectedmenus']);
         $recordsArray=$recordsArray['selectedmenus'];
        //  dd($recordsArray);
        // Validate the incoming request data
         $validator = Validator::make($request->all(), [
            'selectedmenus' => 'required|array|min:1', // Ensure 'products' is a required array with at least one item
            'selectedmenus.*.permiCode' => 'required|numeric|min:0', // Validate each product's name
            'selectedmenus.*.id' => 'required|numeric|min:0', // Validate each product's price
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        // If validation passes, proceed with bulk insertion
        $model = DB::table('permission_details')->where('permiCode', $recordsArray[0]['permiCode'])->delete();
        // dd($model);  


        foreach ($recordsArray as $itemData) {
            $item = new permission_details();
            $item->id = $itemData['id'];
            $item->permiCode = $itemData['permiCode'];
            // ... assign other fields
            $item->save(); // Save the new record
    }


        // return $model;
    }

    function addPermission(Request $request){
        $data = $request->all();
        // dd($data);
        $permission = new permission();
        $permission->permCode = $data['permCode'];
        $permission->Description = $data['Description'];
        $permission->save();

        $permissiondetails= new permission_details();
        $permissiondetails->permiCode = $data['permCode'];
        $permissiondetails->id = 1;
        $permissiondetails->save();


        return response()->json(['message' => 'Permission added successfully', 'permission' => $permission], 201);
    }  
    
    function editpermission(C $request){
        $data = $request->all();
        // dd($data);
        $permission = permission::where('permCode', $data['permCode'])->first();
        if ($permission) {
            $permission->Description = $data['Description'];
            $permission->save();

            return response()->json(['message' => 'Permission updated successfully', 'permission' => $permission], 200);
        } else {
            return response()->json(['message' => 'Permission not found'], 404);
        }
    }   

    function deletepermission(Request $request){
        $data = $request->all();
        // dd($data);
        $permission = permission::where('permCode', $data['permCode'])->first();
        if ($permission) {
            $permission->delete();

            return response()->json(['message' => 'Permission deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Permission not found'], 404);
        }
    }   

}
