@props([
    'variant' => 'default',
])

@php
    $variantClasses = [
        'default' => 'bg-gray-800 hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:ring-indigo-500',
        'primary' => 'bg-blue-600 hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-700 focus:ring-blue-400',
        'success' => 'bg-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700 focus:ring-green-400',
        'danger' => 'bg-red-600 hover:bg-red-500 focus:bg-red-500 active:bg-red-700 focus:ring-red-400',
    ];

    $classes = $variantClasses[$variant] ?? $variantClasses['default'];
@endphp

<button {{ $attributes->merge(['type' => 'submit', 'class' => "inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150 $classes"]) }}>
    {{ $slot }}
</button>
