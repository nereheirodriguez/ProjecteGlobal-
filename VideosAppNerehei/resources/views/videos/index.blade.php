@extends('layouts.VideosAppLayout')

@section('content')
    <div class="max-w-7xl mx-auto container-padding">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-text-primary dark:text-text-black">Tots els Vídeos</h1>
            <a href="{{ route('manage.create') }}"
               class="inline-flex items-center px-8 py-4 border border-transparent text-base font-bold rounded-xl text-text-primary dark:text-text-white bg-accent hover:bg-accent/80 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-115 hover:brightness-110 ring-2 ring-accent">
                Crear Vídeo
            </a>
        </div>
        @if(empty($videos) || !$videos->count())
            <div class="text-center p-6 bg-background-white dark:bg-gray-800 rounded-lg shadow-md">
                <p class="text-lg font-semibold text-text-primary dark:text-text-white">No hi ha vídeos disponibles.</p>
                <p class="text-text-secondary dark:text-text-muted mt-2">
                    <a href="{{ route('manage.create') }}" class="underline hover:text-primary dark:hover:text-primary">Crea un nou vídeo</a> per començar!
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($videos as $video)
                    <x-card
                        :title="$video->title"
                        :description="$video->description"
                        :link="route('videos.show', $video->id)"
                        type="video"
                        :actions="auth()->check() && $video->user_id == auth()->id() ? [
                            ['type' => 'link', 'label' => 'Editar', 'url' => route('manage.edit', $video->id), 'class' => 'text-text-white bg-accent hover:bg-accent/80'],
                            ['type' => 'form', 'label' => 'Eliminar', 'url' => route('manage.destroy', $video->id), 'method' => 'DELETE', 'class' => 'text-text-white bg-primary hover:bg-primary/80', 'confirm' => 'Estàs segur que vols eliminar aquest vídeo?']
                        ] : []"
                    />
                @endforeach
            </div>
        @endif
    </div>
@endsection
