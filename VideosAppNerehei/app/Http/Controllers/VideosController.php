<?php

namespace App\Http\Controllers;

use App\Events\VideoEvent;
use App\Models\Video;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class VideosController extends Controller
{
    public function show($id)
    {
        $video = Video::findOrFail($id);
        return view('videos.show', compact('video'));
    }

    public function testedBy($userId)
    {
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
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'url' => 'required|url',
                'serie_id' => 'nullable|exists:series,id',
            ]);

            $validatedData['published_at'] = now();
            $validatedData['user_id'] = Auth::id();

            $video = Video::create($validatedData);
            event(new VideoEvent($video));

            return redirect()->route('videos.show', $video->id)
                ->with('success', "S’ha creat el vídeo ‘{$video->title}’!");
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', "Error al crear el vídeo: {$e->getMessage()}");
        }
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return view('videos.normaluser.edit', compact('video'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'url' => 'required|url',
                'published_at' => 'nullable|date',
            ]);

            $video = Video::findOrFail($id);
            $video->update($validatedData);

            return redirect()->route('home')
                ->with('success', "S’ha editat el vídeo ‘{$video->title}’!");
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', "Error al editar el vídeo: {$e->getMessage()}");
        }
    }

    public function delete($id)
    {
        $video = Video::findOrFail($id);
        return view('videos.normaluser.delete', compact('video'));
    }

    public function destroy($id)
    {
        try {
            $video = Video::findOrFail($id);
            $title = $video->title;
            $video->delete();

            return redirect()->route('home')
                ->with('success', "S’ha eliminat el vídeo ‘{$title}’!");
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', "Error al eliminar el vídeo: {$e->getMessage()}");
        }
    }
}
