<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Helper\Ucode;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
            'permiCode'=>'0',
            'Profile_Picture' => 'image/Default.png',
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
        Auth::guard('web')->logout();
        //  Auth::user()->tokens()->where('id', $tokenId)->delete();
        // Auth::logout();
     }

     public function profile_code(request $request){
        $input=$request->all();
        $user=DB::table('users')
            ->join('permissions', 'users.permiCode', '=', 'permissions.permCode')
            ->select('users.code','users.name','users.email','permissions.Description','users.Profile_Picture','users.permiCode')
            ->where('code',$input)
            ->get();
            if ($user->isEmpty()) {
                return response()->json(['message' => 'User not found'], 404);
            }
        return $user;
     }

     public function profiles(request $request){
        $input=$request->all();
        $user=DB::table('users')
            ->join('permissions', 'users.permiCode', '=', 'permissions.permCode')
            ->select('users.code','users.name','users.email','permissions.Description','users.Profile_Picture')
            // ->where('code',$input)
            ->get();
            if ($user->isEmpty()) {
                return response()->json(['message' => 'User not found'], 404);
            }
        return $user;
     }

     public function updateuserpermission(request $request){
        $input=$request->all();
        // dd($input);
        $update=DB::table('users')
            ->where('code',$input['code']) // Assuming 'code' is the unique identifier for the user
            ->update(['permiCode' => $input['permiCode']]);
            if ($update) {
                return response()->json(['message' => 'User permission updated successfully'], 200);
            } else {
                return response()->json(['message' => 'Update failed or no changes made'], 400);
            }
     }
}
