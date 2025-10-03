<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authen;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\menu;
use App\Http\Controllers\TeacherController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/Authenticated', function () {
    return true;
});

Route::post('register',[Authen::class,'register']);

Route::post('login',[Authen::class,'login']);
Route::post('logout',[Authen::class,'logout']);
Route::get('users',[Authen::class,'profiles']);

Route::get('thatProfile',[Authen::class,'profile_code']);

Route::get('menuList',[PermissionController::class,'menuFor']);
Route::get('listofPermissions',[PermissionController::class,'index']);
Route::get('thisPermissions',[PermissionController::class,'specificmenu']);
Route::post('UpdatePermissions',[PermissionController::class,'updateBULK']);

Route::get('listofMenu',[menu::class,'index_menu']);

Route::post('save_teacher',[TeacherController::class,'save_data']);