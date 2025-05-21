<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Serie;
use Illuminate\Support\Facades\Auth;

class CreateSeriesModal extends Component
{
    public $show = false;
    public $title = '';
    public $description = '';
    public $image = '';

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|url',
    ];

    public function openModal()
    {
        $this->show = true;
    }

    public function closeModal()
    {
        $this->show = false;
        $this->reset(['title', 'description', 'image']);
    }

    public function save()
    {
        $this->validate();

        Serie::create([
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'user_id' => Auth::id(),
        ]);

        $this->closeModal();
        session()->flash('success', 'Serie creada con éxito.');
        $this->emit('seriesUpdated'); // Opcional: per refrescar la llista
    }

    public function render()
    {
        return view('livewire.create-series-modal');
    }
}
