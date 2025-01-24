<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function show($id)
    {
        $video = Video::findOrFail($id);
        return view('videos.show', compact('video'));
    }

    /**
     * Display the videos tested by a specific user.
     *
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function testedBy($userId)
    {
        $videos = Video::where('tested_by', $userId)->get();
        return response()->json($videos);
    }
}
