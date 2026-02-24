@props(['data'])

<div class="max-w-6xl mx-auto px-4 md:px-6">
    @if($data['heading'] ?? false)
        <h2 class="text-3xl md:text-4xl font-semibold text-gray-900 text-center mb-12">
            {{ $data['heading'] }}
        </h2>
    @endif

    @if(($data['items'] ?? false) && count($data['items']) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($data['items'] as $item)
                <div class="text-center p-6">
                    @if($item['icon'] ?? false)
                        <div class="text-4xl mb-4">{{ $item['icon'] }}</div>
                    @endif

                    @if($item['title'] ?? false)
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">
                            {{ $item['title'] }}
                        </h3>
                    @endif

                    @if($item['description'] ?? false)
                        <p class="text-gray-600">
                            {{ $item['description'] }}
                        </p>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
