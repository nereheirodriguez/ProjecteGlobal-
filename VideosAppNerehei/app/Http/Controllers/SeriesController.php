<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    // Function to list all series
    public function index()
    {
        $series = Serie::all();
        return view('series.index', compact('series'));
    }

    // Function to show a specific series
    public function show($id)
    {
        $serie = Serie::with('videos')->findOrFail($id);
        return view('series.show', compact('serie'));
    }
}
