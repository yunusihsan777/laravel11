<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function index()
    {
        return view('keputusan');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048', // Max size 2MB
        ]);

        // Store the file
        $file = $request->file('file');
        $path = $file->store('uploads', 'public');

        return response()->json([
            'success' => true,
            'message' => 'File has been uploaded successfully!',
        ]);
    }
}
