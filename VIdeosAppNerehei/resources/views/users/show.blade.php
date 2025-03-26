@extends('layouts.VideosAppLayout')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <a href="{{ route('users.index') }}" class="text-indigo-600 hover:text-indigo-900">
                &larr; Volver a la lista de usuarios
            </a>
        </div>

        <!-- User Information Card -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-gray-200">
                <h1 class="text-2xl font-bold text-gray-900">Información del Usuario</h1>
            </div>
            <div class="p-6 flex items-start">
                <div>
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h2>
                        <p class="text-sm text-gray-600">{{ $user->email }}</p>
                    </div>

                    <div class="mt-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                        {{ $user->videos->count() }} videos
                    </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- User's Videos Section -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Videos de {{ $user->name }}</h2>
            </div>

            @if($user->videos->count() > 0)
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
                    @foreach($user->videos as $video)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="text-sm flex justify-center font-medium text-gray-900">{{ $video->title }}</div>
                                <div class="text-sm flex justify-center text-gray-500">{{ Str::limit($video->description, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm flex justify-center text-gray-500">{{ $video->created_at->format('d/m/Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('videos.show', $video->id) }}" class="text-indigo-600 flex justify-center hover:text-indigo-900 mr-3">
                                    Ver
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="p-6 text-center text-gray-500">
                    Este usuario no tiene videos.
                </div>
            @endif
        </div>
    </div>
@endsection
