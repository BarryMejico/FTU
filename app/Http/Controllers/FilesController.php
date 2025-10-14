<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    // Return list of uploaded files (public disk)
    public function index(Request $request)
    {
        $files = [];
        // list files in storage/app/public/files
        $all = Storage::disk('public')->files('files');
        foreach ($all as $path) {
            $last = Storage::disk('public')->lastModified($path);
            $files[] = [
                'path' => $path,
                'url' => url('storage/' . $path),
                'name' => basename($path),
                'uploaded' => date('Y-m-d H:i:s', $last),
                'size' => Storage::disk('public')->size($path),
            ];
        }
        return response()->json($files);
    }

    // Handle upload
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:51200', // 50MB
        ]);

        $file = $request->file('file');
        $path = $file->store('files', 'public');

        return response()->json([
            'success' => true,
            'path' => $path,
            'url' => Storage::url($path),
            'name' => basename($path),
        ]);
    }
}
