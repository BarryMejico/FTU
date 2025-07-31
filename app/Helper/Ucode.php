<?php

use SebastianBergmann\Environment\Console;
use Illuminate\Http\Request;
use App\Menu;
use Illuminate\Support\Facades\DB;

if (!function_exists('custom')) {
    
    function Ucode() {
        $d = date("yymd");
        $rand=rand(10,100);
        $code = $d.$rand;
        return $code;
}



function getUser(){
    return auth()->user();
}

function PO_details(){
$PO_detail=array(
        "icode",
        "idescription",
        "iunit",
        "Qty",
        "Ucost",
        "Tcost"
);

}

function listofmenu(){
     $permCode=getUser()->permCode;
            $Menu= DB::table('permission_details')
            ->join('menus', 'menus.id', '=', 'permission_details.id')
            ->where('permission_details.permCode',$permCode)
            ->select('menus.*')
            ->get();
    return $Menu;
   
}



 }

