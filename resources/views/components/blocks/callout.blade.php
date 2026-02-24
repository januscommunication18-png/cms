@props(['data'])

@php
    $type = $data['type'] ?? 'info';
    $colors = [
        'info' => 'bg-blue-50 border-blue-200 text-blue-800',
        'success' => 'bg-green-50 border-green-200 text-green-800',
        'warning' => 'bg-yellow-50 border-yellow-200 text-yellow-800',
        'error' => 'bg-red-50 border-red-200 text-red-800',
    ];
    $colorClass = $colors[$type] ?? $colors['info'];
@endphp

<div class="max-w-6xl mx-auto px-4 md:px-6">
    <div class="{{ $colorClass }} border-l-4 p-6 rounded-r-lg">
        @if($data['title'] ?? false)
            <h3 class="font-semibold text-lg mb-2">{{ $data['title'] }}</h3>
        @endif

        @if($data['content'] ?? false)
            <div class="prose prose-sm max-w-none
                        [&_ul]:list-disc [&_ul]:ml-6
                        [&_ol]:list-decimal [&_ol]:ml-6
                        [&_li]:mb-1
                        [&_a]:underline">
                {!! $data['content'] !!}
            </div>
        @endif
    </div>
</div>
