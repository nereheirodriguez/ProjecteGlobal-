<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Test;
use Illuminate\Http\Request;

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
        $tests = Test::where('some_column', 'some_value')->get();
        $videos = Video::all();
        return view('videos.index', compact('videos'));
        $tests = Test::where('some_column', 'some_value')->get();

    }
}
