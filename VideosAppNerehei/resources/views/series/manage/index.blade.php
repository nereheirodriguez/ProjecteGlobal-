@extends('layouts.VideosAppLayout')

@section('content')
    <div class="max-w-7xl mx-auto container-padding">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-text-primary dark:text-text-black">Gestió de Sèries</h1>
            <a href="{{ route('series.manage.create') }}"
               class="inline-flex items-center px-8 py-4 border border-transparent text-base font-bold rounded-xl text-text-primary dark:text-text-white bg-accent hover:bg-accent/80 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-115 hover:brightness-110 ring-2 ring-accent">
                Crear una sèrie
            </a>
        </div>
        @if(empty($series) || !$series->count())
            <div class="text-center p-6 bg-background-white dark:bg-gray-800 rounded-lg shadow-md">
                <p class="text-lg font-semibold text-text-primary dark:text-text-white">No hi ha sèries disponibles.</p>
                <p class="text-text-secondary dark:text-text-muted mt-2">
                    <a href="{{ route('series.manage.create') }}" class="underline hover:text-primary dark:hover:text-primary">Crea una nova sèrie</a> per començar!
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($series as $serie)
                    <x-card
                        :title="$serie->title"
                        :description="$serie->description"
                        :image="$serie->image"
                        :link="route('serie.show', $serie->id)"
                        type="series"
                        :actions="[
                            ['type' => 'link', 'label' => 'Veure', 'url' => route('serie.show', $serie->id), 'class' => 'text-text-white bg-secondary hover:bg-secondary/80'],
                            ['type' => 'link', 'label' => 'Editar', 'url' => route('series.manage.edit', $serie->id), 'class' => 'text-text-white bg-accent hover:bg-accent/80'],
                            ['type' => 'link', 'label' => 'Eliminar', 'url' => route('series.manage.delete', $serie->id), 'class' => 'text-text-white bg-primary hover:bg-primary/80']
                        ]"
                    />
                @endforeach
            </div>
        @endif
    </div>
@endsection
