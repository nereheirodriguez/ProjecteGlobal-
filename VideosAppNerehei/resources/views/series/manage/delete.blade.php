@extends('layouts.VideosAppLayout')

@section('content')
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Confirmar eliminación de serie
                </h3>
                    <form action="{{ route('series.manage.destroy', $serie->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <!-- Input oculto con valor por defecto -->
                        <input type="hidden" name="delete_videos" value="0">

                        <label for="delete_videos" class="inline-flex items-center">
                            <input type="checkbox" id="delete_videos" name="delete_videos" value="1" class="form-checkbox h-4 w-4 text-red-600 transition duration-150 ease-in-out">
                            <span class="ml-2 text-sm text-gray-600">Eliminar todos los videos relacionados con esta serie</span>
                        </label>

                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Eliminar Serie
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
