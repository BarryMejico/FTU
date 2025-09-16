<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class imgserver extends Controller
{
    public function show($filename)
    {
        // dd($filename);
        $path = 'public/assets/' . $filename;  //Adjust path based on your storage location

        if (!Storage::exists($path)) {
            abort(404);
        }

        return response()->file(Storage::path($path));
    }
}
