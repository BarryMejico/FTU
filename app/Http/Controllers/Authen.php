<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Helper\Ucode;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Authen extends Controller
{
    public function register(request $REQUEST){
        $REQUEST->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            // 'type'=>['required', 'string'],
        ]);

        //generate own code for monitoring
        $Code=strval(Ucode()) . "-" . strval(DB::table('users')->count());
        
        //save the data from request
        $user= User::create([
            'name' => $REQUEST['name'],
            'email' => $REQUEST['email'],
            'password' => Hash::make($REQUEST['password']),
            'code' => $Code,
            'permiCode'=>'1',
        ]);
        $message ="Data has been saved";
        return ;
    }

    public function login(request $REQUEST){
        $REQUEST->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::Attempt($REQUEST->only('email','password'))){
            return response()->json(Auth::User(),200);
        }
        throw ValidationException::withmessages([
                'email'=>['Incorrecr Credentials!']
        ]);


    }

    public function logout(){
        Auth::logout();
     }

     public function profile_code(request $request){
        $input=$request->all();
        $user=DB::table('users')
            ->select('users.code','users.name')
            ->where('code',$input)
            ->get();
        return $user;
     }
}
