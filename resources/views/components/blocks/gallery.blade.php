@props(['data'])

<div class="max-w-6xl mx-auto px-4 md:px-6">
    @if(($data['images'] ?? false) && count($data['images']) > 0)
        @php
            $columns = $data['columns'] ?? 3;
            $gridCols = match($columns) {
                1 => 'grid-cols-1',
                2 => 'grid-cols-1 md:grid-cols-2',
                3 => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3',
                default => 'grid-cols-2 md:grid-cols-3 lg:grid-cols-4'
            };
        @endphp
        <div class="grid {{ $gridCols }} gap-4">
            @foreach($data['images'] as $image)
                <div class="overflow-hidden rounded-lg">
                    <img src="{{ asset('storage/' . ($image['path'] ?? $image)) }}"
                         alt="{{ $image['caption'] ?? '' }}"
                         class="w-full h-64 object-cover hover:scale-105 transition duration-300">
                </div>
            @endforeach
        </div>
    @endif
</div>
