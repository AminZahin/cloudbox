<?php

namespace App\Http\Controllers;

use App\Models\StoredFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        $files = StoredFile::where(
            'tenant_id',
            Auth::user()->tenant_id
        )
        ->latest()
        ->get();

        return view('files.index', compact('files'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'max:10240'],
        ]);

        $uploadedFile = $request->file('file');

        $path = $uploadedFile->store('uploads');

        StoredFile::create([
            'tenant_id' => Auth::user()->tenant_id,
            'folder_id' => null,
            'original_name' => $uploadedFile->getClientOriginalName(),
            'stored_name' => basename($path),
            'path' => $path,
            'size' => $uploadedFile->getSize(),
            'mime_type' => $uploadedFile->getMimeType(),
        ]);

        return back()->with('success', 'File uploaded.');
    }

    public function download(StoredFile $storedFile)
    {
        abort_if(
            $storedFile->tenant_id !== Auth::user()->tenant_id,
            403
        );

        return Storage::download(
            $storedFile->path,
            $storedFile->original_name
        );
    }

    public function destroy(StoredFile $storedFile)
    {
        abort_if(
            $storedFile->tenant_id !== Auth::user()->tenant_id,
            403
        );

        if (Storage::exists($storedFile->path)) {
            Storage::delete($storedFile->path);
        }

        $storedFile->delete();

        return back()->with('success', 'File deleted.');
    }
}