@props(['data'])

<div class="bg-gray-50">
    <div class="max-w-6xl mx-auto px-4 md:px-6 py-12 md:py-16">
        @if($data['heading'] ?? false)
            <h2 class="text-3xl md:text-4xl font-semibold text-gray-900 text-center mb-12">
                {{ $data['heading'] }}
            </h2>
        @endif

        @if(($data['stats'] ?? false) && count($data['stats']) > 0)
            @php
                $columns = count($data['stats']);
                $gridCols = match(true) {
                    $columns === 1 => 'grid-cols-1',
                    $columns === 2 => 'grid-cols-1 md:grid-cols-2',
                    $columns === 3 => 'grid-cols-1 md:grid-cols-3',
                    default => 'grid-cols-2 md:grid-cols-4'
                };
            @endphp
            <div class="grid {{ $gridCols }} gap-8 md:gap-12">
                @foreach($data['stats'] as $stat)
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl lg:text-6xl font-bold text-[#00959f] mb-2">
                            {{ $stat['value'] ?? '' }}
                        </div>
                        <div class="text-gray-600 text-lg">
                            {{ $stat['label'] ?? '' }}
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
