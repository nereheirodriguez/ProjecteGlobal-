@extends('layouts.VideosAppLayout')

@section('content')
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Confirmar eliminación de video
                </h3>
                <div class="mt-2 max-w-xl text-sm text-gray-500">
                    <p>¿Estás seguro de que deseas eliminar el siguiente video? Esta acción no se puede deshacer.</p>
                </div>
                <div class="mt-5 bg-gray-50 border border-gray-200 rounded-md p-4">
                    <h4 class="text-md font-medium text-gray-900">{{ $video->title }}</h4>
                    <p class="mt-1 text-sm text-gray-600">{{ Str::limit($video->description, 100) }}</p>
                    <p class="mt-1 text-sm text-gray-500">URL: {{ $video->url }}</p>

                @if($video->published_at)
                        <p class="mt-1 text-sm text-gray-500">Publicado el: {{ $video->formatted_for_humans_published_at ?? ''}}</p>
                    @endif
                </div>
                <div class="mt-5 flex justify-end space-x-3">
                    <a href="{{ route('manage.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancelar
                    </a>
                    <form action="{{ route('manage.destroy', $video->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Eliminar Video
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
