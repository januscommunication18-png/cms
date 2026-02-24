@props(['data'])

<div class="max-w-6xl mx-auto px-4 md:px-6">
    @if($data['heading'] ?? false)
        <h2 class="text-3xl md:text-4xl font-semibold text-gray-900 mb-12">
            {{ $data['heading'] }}
        </h2>
    @endif

    @if(($data['items'] ?? false) && count($data['items']) > 0)
        <div class="relative">
            <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-200"></div>

            <div class="space-y-12">
                @foreach($data['items'] as $item)
                    <div class="relative pl-12">
                        <div class="absolute left-0 w-8 h-8 bg-[#00959f] rounded-full flex items-center justify-center">
                            <div class="w-3 h-3 bg-white rounded-full"></div>
                        </div>

                        @if($item['date'] ?? false)
                            <span class="text-sm text-[#00959f] font-medium">
                                {{ $item['date'] }}
                            </span>
                        @endif

                        @if($item['title'] ?? false)
                            <h3 class="text-xl font-semibold text-gray-900 mt-1 mb-2">
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
        </div>
    @endif
</div>
