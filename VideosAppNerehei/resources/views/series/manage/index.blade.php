@extends('layouts.VideosAppLayout')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Gestión de Series</h1>
            <a href="{{ route('series.manage.create') }}"
               class="inline-flex items-center px-8 py-4 border border-transparent text-base font-bold rounded-xl text-gray-900 bg-lime-400 hover:bg-lime-500 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-115 hover:brightness-110 ring-2 ring-lime-500">
                Crear una serie
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($series as $serie)
                <x-card
                    :title="$serie->title"
                    :description="$serie->description"
                    :image="$serie->image"
                    :link="route('serie.show', $serie->id)"
                    type="series"
                    :actions="[
                        ['type' => 'link', 'label' => 'Ver', 'url' => route('serie.show', $serie->id), 'class' => 'text-black bg-blue-600 hover:bg-blue-700'],
                        ['type' => 'link', 'label' => 'Editar', 'url' => route('series.manage.edit', $serie->id), 'class' => 'text-black bg-amber-500 hover:bg-amber-600'],
                        ['type' => 'link', 'label' => 'Eliminar', 'url' => route('series.manage.delete', $serie->id), 'class' => 'text-white bg-red-600 hover:bg-red-700']
                    ]"
                />
            @endforeach
        </div>
    </div>
@endsection
