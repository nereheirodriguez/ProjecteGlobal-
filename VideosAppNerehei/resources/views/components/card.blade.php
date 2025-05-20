@props([
    'title' => '',
    'description' => '',
    'image' => null,
    'link' => '#',
    'actions' => [],
    'type' => 'default', // 'series', 'video', 'user'
])

<div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-105">
    <a href="{{ $link }}" class="block">
        @if ($image && $type === 'series')
            <div class="aspect-w-16 aspect-h-9">
                <img src="{{ $image }}" alt="{{ $title }}" class="object-cover w-full h-full">
            </div>
        @elseif ($type === 'video')
            <div class="aspect-w-16 aspect-h-9 bg-gray-200 flex items-center justify-center">
                <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        @elseif ($type === 'user')
            <div class="aspect-w-1 aspect-h-1 bg-gray-200 flex items-center justify-center">
                <svg class="h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
        @endif
        <div class="p-4">
            <h2 class="text-lg font-semibold text-gray-900 line-clamp-2">{{ $title }}</h2>
            @if ($description)
                <p class="mt-2 text-sm text-gray-600 line-clamp-2">{{ $description }}</p>
            @endif
            @if ($type === 'user' && isset($attributes['role']))
                <p class="mt-1 text-sm text-gray-500">{{ $attributes['role'] }}</p>
            @endif
        </div>
    </a>
    @if (!empty($actions))
        <div class="p-4 flex justify-between border-t border-gray-200 space-x-2">
            @foreach ($actions as $action)
                @if ($action['type'] === 'link')
                    <a href="{{ $action['url'] }}"
                       class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-md {{ $action['class'] }}">
                        {{ $action['label'] }}
                    </a>
                @elseif ($action['type'] === 'form')
                    <form action="{{ $action['url'] }}" method="POST" onsubmit="return confirm('{{ $action['confirm'] }}');">
                        @csrf
                        @method($action['method'])
                        <button type="submit"
                                class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-md {{ $action['class'] }}">
                            {{ $action['label'] }}
                        </button>
                    </form>
                @endif
            @endforeach
        </div>
    @endif
</div>
