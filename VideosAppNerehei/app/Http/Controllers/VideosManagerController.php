<?php

namespace App\Http\Controllers;

use App\Events\VideoCreated;
use App\Events\VideoEvent;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideosManagerController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        return view('videos.manage.index', compact('videos'));
    }

    public function create()
    {
        return view('videos.manage.create');
    }

    public function store(Request $request)
    {
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

        return redirect()->route('videos.show', $video->id);
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return view('videos.manage.edit', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
            'published_at' => 'nullable|date',
            'serie_id' => 'nullable|exists:series,id',
        ]);

        $video = Video::findOrFail($id);
        $video->update($validatedData);
        return redirect()->route('manage.index', $video->id);
    }

    public function delete($id)
    {
        $video = Video::findOrFail($id);return view('videos.manage.delete', compact('video'));
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();
        return redirect()->route('manage.index');
    }
}
