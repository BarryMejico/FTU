<?php

use Illuminate\Support\Facades\Route;
// routes/web.php
use App\Http\Controllers\imgserver;

Route::get('/image/{filename}', [imgserver::class, 'show'])->name('image.show');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::any('{any}', function () {
    return view('welcome');
})->where('any', '.*');


Route::get('/', function () {
    return view('welcome');
});

