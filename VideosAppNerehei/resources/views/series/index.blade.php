@extends('layouts.VideosAppLayout')

@section('content')
    <div class="max-w-7xl mx-auto container-padding">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Todas las Series</h1>
            <a href="{{ route('series.create') }}"
               class="bg-lime-400 hover:bg-lime-500 text-gray-900 px-8 py-4 rounded-xl text-base font-bold transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-115 hover:brightness-110 ring-2 ring-lime-500">
                Crear Serie
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($series as $serie)
                <x-card
                    :title="$serie->title"
                    :description="$serie->description"
                    :image="$serie->image"
                    :link="route('serie.show', $serie->id)"
                    type="series"
                />
            @endforeach
        </div>
    </div>
@endsection
