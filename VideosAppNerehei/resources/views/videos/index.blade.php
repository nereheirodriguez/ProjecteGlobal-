@extends('layouts.VideosAppLayout')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Todos los Videos</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($videos as $video)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <a href="{{ route('videos.show', $video->id) }}" class=" block">
                        <div class="aspect-w-16 aspect-h-9">
                        </div>
                        <div class="p-4">
                            <h2 class="text-lg font-semibold text-gray-900 line-clamp-2">{{ $video->title }}</h2>
                            <p class="mt-1 text-sm text-gray-500">
                            </p>
                            <p class="mt-2 text-sm text-gray-600 line-clamp-2">{{ $video->description }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
@endsection
