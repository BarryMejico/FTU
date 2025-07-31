<?php

namespace App\Http\Controllers;

use App\Models\permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
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
        ->join('menus', 'menus.id', '=', 'permission_details.id')
        ->where('permission_details.permiCode',$id['id'])
        ->select('menus.*')
        ->get();
        return $Menu;
    }
}
