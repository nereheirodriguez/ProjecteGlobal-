<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Media = Media::all()->load('user');
        return response()->json($Media);
    }

    public function myfiles()
    {
        $user = auth()->user();
        $media = $user->media()->get();
        return response()->json($media);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'files' => 'required|array',
            'files.*' => 'file|mimes:jpg,jpeg,png,gif,mp4,mov,avi|max:20480',
        ]);

        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'No autenticado'], 401);
        }

        $uploadedFiles = [];

        foreach ($request->file('files') as $file) {
            $path = $file->store('Media', 'local');

            $media = Media::create([
                'user_id' => $user->id,
                'path' => $path,
            ]);

            $uploadedFiles[] = $media;
        }

        return response()->json($uploadedFiles, 201);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $media = Media::find($id);

        if (!$media) {
            return response()->json(['error' => 'Media not found'], 404);
        }

        if (!$media->path) {
            return response()->json(['error' => 'File path is null'], 500);
        }

        Storage::disk('local')->delete($media->path);
        $media->delete();

        return response()->json(null, 204);
    }


}
