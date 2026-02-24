@props(['data'])

@php
    $bgColor = $data['background_color'] ?? '#00959f';
@endphp

<div style="background-color: {{ $bgColor }}">
    <div class="max-w-6xl mx-auto px-4 md:px-6 py-12 md:py-16 text-center">
        @if($data['title'] ?? $data['heading'] ?? false)
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                {{ $data['title'] ?? $data['heading'] }}
            </h2>
        @endif

        @if($data['description'] ?? false)
            <p class="text-xl text-white/90 mb-8">
                {{ $data['description'] }}
            </p>
        @endif

        @if($data['button_text'] ?? false)
            <a href="{{ $data['button_url'] ?? '#' }}"
               class="inline-block bg-white text-gray-900 font-semibold px-8 py-4 rounded-lg hover:bg-gray-100 transition shadow-lg">
                {{ $data['button_text'] }}
            </a>
        @endif
    </div>
</div>
