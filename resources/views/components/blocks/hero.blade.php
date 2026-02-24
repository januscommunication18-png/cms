@props(['data'])

@php
    $layout = $data['layout'] ?? 'full-width';
    $bgColor = $data['bg_color'] ?? '#f3f4f6';
    $overlayOpacity = ($data['overlay_opacity'] ?? 40) / 100;
    $overlayColor = $data['overlay_color'] ?? '#000000';
    $textAlignment = $data['text_alignment'] ?? 'center';

    $alignmentClass = match($textAlignment) {
        'left' => 'text-left',
        'right' => 'text-right',
        default => 'text-center'
    };
@endphp

@if($layout === 'full-width')
    {{-- Full Width Background --}}
    <div class="relative w-full min-h-[60vh] md:min-h-[80vh] flex items-center justify-center overflow-hidden">
        @if($data['image'] ?? false)
            <img src="{{ asset('storage/' . $data['image']) }}"
                 alt="{{ $data['title'] ?? '' }}"
                 class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0" style="background-color: {{ $overlayColor }}; opacity: {{ $overlayOpacity }}"></div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-gray-800 to-gray-900"></div>
        @endif

        <div class="relative z-10 {{ $alignmentClass }} text-white px-4 max-w-4xl mx-auto">
            @if($data['title'] ?? false)
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                    {{ $data['title'] }}
                </h1>
            @endif

            @if($data['subtitle'] ?? false)
                <div class="text-xl md:text-2xl text-gray-200">
                    {!! $data['subtitle'] !!}
                </div>
            @endif
        </div>
    </div>

@elseif($layout === 'fixed-width')
    {{-- Fixed Width Image --}}
    <div class="max-w-6xl mx-auto px-4 md:px-6">
        <div class="relative rounded-2xl overflow-hidden min-h-[400px] md:min-h-[500px] flex items-center justify-center">
            @if($data['image'] ?? false)
                <img src="{{ asset('storage/' . $data['image']) }}"
                     alt="{{ $data['title'] ?? '' }}"
                     class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0" style="background-color: {{ $overlayColor }}; opacity: {{ $overlayOpacity }}"></div>
            @else
                <div class="absolute inset-0 bg-gradient-to-br from-gray-800 to-gray-900"></div>
            @endif

            <div class="relative z-10 {{ $alignmentClass }} text-white px-6 md:px-12 max-w-3xl mx-auto">
                @if($data['title'] ?? false)
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 leading-tight">
                        {{ $data['title'] }}
                    </h1>
                @endif

                @if($data['subtitle'] ?? false)
                    <div class="text-lg md:text-xl text-gray-200">
                        {!! $data['subtitle'] !!}
                    </div>
                @endif
            </div>
        </div>
    </div>

@elseif($layout === 'full-bg-fixed-image')
    {{-- Full Width Background + Fixed Image in Center --}}
    <div class="w-full py-12 md:py-16" style="background-color: {{ $bgColor }}">
        <div class="max-w-6xl mx-auto px-4 md:px-6">
            <div class="relative rounded-2xl overflow-hidden min-h-[400px] md:min-h-[500px] flex items-center justify-center">
                @if($data['image'] ?? false)
                    <img src="{{ asset('storage/' . $data['image']) }}"
                         alt="{{ $data['title'] ?? '' }}"
                         class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0" style="background-color: {{ $overlayColor }}; opacity: {{ $overlayOpacity }}"></div>
                @else
                    <div class="absolute inset-0 bg-gradient-to-br from-gray-800 to-gray-900"></div>
                @endif

                <div class="relative z-10 {{ $alignmentClass }} text-white px-6 md:px-12 max-w-3xl mx-auto">
                    @if($data['title'] ?? false)
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 leading-tight">
                            {{ $data['title'] }}
                        </h1>
                    @endif

                    @if($data['subtitle'] ?? false)
                        <div class="text-lg md:text-xl text-gray-200">
                            {!! $data['subtitle'] !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
