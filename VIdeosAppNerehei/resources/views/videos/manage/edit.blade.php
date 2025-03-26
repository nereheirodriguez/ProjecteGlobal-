@extends('layouts.VideosAppLayout')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Editar Video</h1>

        <form action="{{ route('manage.update', $video->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                <input type="text" name="title" id="title" value="{{ old('title', $video->title) }}" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="description" id="description" rows="4" required
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('description', $video->description) }}</textarea>
            </div>

            <div>
                <label for="url" class="block text-sm font-medium text-gray-700">URL del Video</label>
                <input type="url" name="url" id="url" value="{{ old('url', $video->url) }}" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>

            <div>
                <label for="published_at" class="block text-sm font-medium text-gray-700">Fecha de Publicación</label>
                <input type="datetime-local" name="published_at" id="published_at"
                       value="{{ old('published_at', $video->formatted_for_humans_published_at ?? '') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>

            <div>
                <label for="previous" class="block text-sm font-medium text-gray-700">Video Anterior (ID)</label>
                <input type="number" name="previous" id="previous" value="{{ old('previous', $video->previous) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>

            <div>
                <label for="next" class="block text-sm font-medium text-gray-700">Video Siguiente (ID)</label>
                <input type="number" name="next" id="next" value="{{ old('next', $video->next) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>

            <div>
                <label for="series_id" class="block text-sm font-medium text-gray-700">ID de la Serie</label>
                <input type="number" name="series_id" id="series_id" value="{{ old('series_id', $video->series_id) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>

            <div class="flex items-center justify-end space-x-3">
                <a href="{{ route('manage.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancelar
                </a>
                <button type="submit" class="text-black inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium  bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
@endsection
