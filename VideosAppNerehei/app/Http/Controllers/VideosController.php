<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideosController extends Controller
{
    public function show($id)
    {
        $video = Video::findOrFail($id);
        return view('videos.show', compact('video'));
    }

    /**
     * Display the test class for videos tested by a specific user.
     *
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function testedBy($userId)
    {
        // Obtenim els tests realitzats per l'usuari
        $tests = Test::where('tested_by', $userId)->get();

        return response()->json($tests);
    }
    public function index()
    {
        $videos = Video::all();
        $user = Auth::user();
        return view('videos.index', compact('videos', 'user'));
    }
    public function create()
    {
        return view('videos.normaluser.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',

        ]);

        $validatedData['published_at'] = now();
        $validatedData['user_id'] = Auth::id();

        $video = Video::create($validatedData);
        return redirect()->route('videos.show', $video->id);
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return view('videos.normaluser.edit', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
            'published_at' => 'nullable|date',
        ]);

        $video = Video::findOrFail($id);
        $video->update($validatedData);
        return redirect()->route('home', $video->id);
    }

    public function delete($id)
    {
        $video = Video::findOrFail($id);return view('videos.normaluser.delete', compact('video'));
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();
        return redirect()->route('home');
    }
}
