<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class SeriesManageController extends Controller
{
    public function index()
    {
        $series = Serie::all();
        return view('series.manage.index', compact('series'));
    }

    public function create()
    {
        return view('series.manage.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'required|url',
            ]);

            $serie = Serie::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'image' => $validated['image'],
                'user_id' => Auth::id(),
            ]);

            return redirect()->route('series.manage.index')
                ->with('success', "S’ha creat la sèrie ‘{$serie->title}’!");
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', "Error al crear la sèrie: {$e->getMessage()}");
        }
    }

    public function edit($id)
    {
        $serie = Serie::findOrFail($id);
        return view('series.manage.edit', compact('serie'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'required|url',
            ]);

            $serie = Serie::findOrFail($id);
            $serie->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'image' => $validated['image'],
            ]);

            return redirect()->route('series.manage.index')
                ->with('success', "S’ha editat la sèrie ‘{$serie->title}’!");
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', "Error al editar la sèrie: {$e->getMessage()}");
        }
    }

    public function delete($id)
    {
        $serie = Serie::findOrFail($id);
        return view('series.manage.delete', compact('serie'));
    }

    public function destroy(Request $request, $id)
    {
        try {
            $serie = Serie::findOrFail($id);
            $title = $serie->title;

            if ($request->delete_videos == 1) {
                $serie->videos()->delete();
            }

            $serie->delete();

            return redirect()->route('series.manage.index')
                ->with('success', "S’ha eliminat la sèrie ‘{$title}’!");
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', "Error al eliminar la sèrie: {$e->getMessage()}");
        }
    }

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
