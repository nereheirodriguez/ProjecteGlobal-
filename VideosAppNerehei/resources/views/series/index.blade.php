@extends('layouts.VideosAppLayout')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Todas las Series</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($series as $serie)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <a href="{{ route('serie.show', $serie->id) }}" class="block">
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="{{ $serie->image }}" alt="{{ $serie->title }}" class="object-cover w-full h-full">
                        </div>
                        <div class="p-4">
                            <h2 class="text-lg font-semibold text-gray-900 line-clamp-2">{{ $serie->title }}</h2>
                            <p class="mt-2 text-sm text-gray-600 line-clamp-2">{{ $serie->description }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
@endsection
