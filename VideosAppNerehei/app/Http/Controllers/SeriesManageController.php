<?php
namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeriesManageController extends Controller
{
    // Function to list all series
    public function index()
    {
        $series = Serie::all();
        return view('series.manage.index', compact('series'));
    }

    // Function to show the form for creating a new series
    public function create()
    {
        return view('series.manage.create');
    }

    // Function to store a newly created series in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|url',
        ]);

        Serie::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('series.manage.index')->with('success', 'Serie created successfully.');
    }

    // Function to show the form for editing a series
    public function edit($id)
    {
        $serie = Serie::findOrFail($id);
        return view('series.manage.edit', compact('serie'));
    }

    // Function to update a series in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|url',
        ]);

        $serie = Serie::findOrFail($id);
        $serie->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
        ]);

        return redirect()->route('series.manage.index')->with('success', 'Serie updated successfully.');
    }

    // Function to show the confirmation form for deleting a series
    public function delete($id)
    {
        $serie = Serie::findOrFail($id);
        return view('series.manage.delete', compact('serie'));
    }

    // Function to delete a series from the database
    public function destroy(Request $request, $id)
    {
        $serie = Serie::findOrFail($id);

        // Si delete_videos está marcado (1), elimina los videos relacionados
        if ($request->delete_videos == 1) {
            $serie->videos()->delete();
        }

        $serie->delete();

        return redirect()->route('series.manage.index')->with('success', 'Serie eliminada correctamente.');
    }


    // Function to get series tested by a specific user
    public function testedBy($userId)
    {
        $series = Serie::whereHas('videos', function ($query) use ($userId) {
            $query->whereHas('tests', function ($query) use ($userId) {
                $query->where('tested_by', $userId);
            });
        })->get();

        return view('series.tested_by', compact('series'));
    }
}
