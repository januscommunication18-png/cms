@props(['data'])

@php
    $size = $data['size'] ?? 'full';
    $sizeClass = match($size) {
        'small' => 'max-w-2xl',
        'medium' => 'max-w-4xl',
        'large' => 'max-w-5xl',
        default => 'max-w-6xl'
    };
@endphp

<div class="max-w-6xl mx-auto px-4 md:px-6">
    <div class="{{ $sizeClass }} mx-auto">
    @if($data['image'] ?? false)
        <figure>
            <img src="{{ asset('storage/' . $data['image']) }}"
                 alt="{{ $data['alt'] ?? '' }}"
                 class="w-full rounded-lg shadow-lg">

            @if($data['caption'] ?? false)
                <figcaption class="mt-4 text-center text-gray-500 text-sm">
                    {{ $data['caption'] }}
                </figcaption>
            @endif
        </figure>
    @endif
    </div>
</div>
