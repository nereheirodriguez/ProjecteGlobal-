@extends('layouts.VideosAppLayout')

@section('content')
    <div class="max-w-7xl mx-auto container-padding">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-text-primary dark:text-text-black">Totes les Sèries</h1>
            <a href="{{ route('series.create') }}" class="bg-accent hover:bg-accent/80 text-text-primary dark:text-text-white px-8 py-4 rounded-xl text-base font-bold transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-115 hover:brightness-110 ring-2 ring-accent">
                Crear Sèrie
            </a>
        </div>
        @if(empty($series) || !$series->count())
            <div class="text-center p-6 bg-background-white dark:bg-gray-800 rounded-lg shadow-md">
                <p class="text-lg font-semibold text-text-primary dark:text-text-white">No hi ha sèries disponibles.</p>
                <p class="text-text-secondary dark:text-text-muted mt-2">
                    <a href="{{ route('series.create') }}" class="underline hover:text-primary dark:hover:text-primary">Crea una nova sèrie</a> per començar!
                </p>
            </div>
        @else
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
        @endif
    </div>
@endsection
