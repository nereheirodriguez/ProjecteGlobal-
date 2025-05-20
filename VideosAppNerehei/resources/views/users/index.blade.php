@extends('layouts.VideosAppLayout')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Todos los Usuarios</h1>

        <!-- Taula per a pantalles grans -->
        <div class="hidden md:block bg-white rounded-lg shadow-md overflow-hidden">
            <table class="w-full min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Acciones
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ $user->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('users.show', $user->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                Ver detalles
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Llista per a mòbil -->
        <div class="md:hidden bg-white rounded-lg shadow-md divide-y divide-gray-200">
            @foreach($users as $user)
                <div class="p-4">
                    <div class="mb-2">
                        <span class="text-xs font-medium text-gray-500 uppercase">Nombre</span>
                        <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                    </div>
                    <div class="mb-2">
                        <span class="text-xs font-medium text-gray-500 uppercase">Email</span>
                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-medium text-gray-500 uppercase">Acciones</span>
                        <p class="text-sm font-medium">
                            <a href="{{ route('users.show', $user->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                Ver detalles
                            </a>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
