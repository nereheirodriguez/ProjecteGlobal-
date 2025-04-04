@extends('layouts.VideosAppLayout')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <a href="{{ route('serie.index') }}" class="text-indigo-600 hover:text-indigo-900">
                &larr; Volver a la lista de series
            </a>
        </div>
        <!-- Series Information Card -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-gray-200">
                <h1 class="text-2xl font-bold text-gray-900">{{ $serie->title }}</h1>
            </div>
            <div class="p-6">
                <p class="text-sm text-gray-600">{{ $serie->description }}</p>
                <div class="mt-4">
                    <img src="{{ $serie->image }}" alt="{{ $serie->title }}" class="w-3/5 h-auto rounded-md">
                </div>
            </div>
        </div>

        <!-- Series Videos Section -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Videos de la serie</h2>
            </div>

            @if($serie->videos->count() > 0)
                <table class="w-full min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Título
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Fecha
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Acciones
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($serie->videos as $video)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $video->title }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($video->description, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $video->created_at->format('d/m/Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('videos.show', $video->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                    Ver
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="p-6 text-center text-gray-500">
                    Esta serie no tiene videos.
                </div>
            @endif
        </div>
    </div>
@endsection
