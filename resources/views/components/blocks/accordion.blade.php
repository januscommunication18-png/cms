@props(['data'])

<div class="max-w-6xl mx-auto px-4 md:px-6">
    @if($data['heading'] ?? false)
        <h2 class="text-3xl md:text-4xl font-semibold text-gray-900 mb-8">
            {{ $data['heading'] }}
        </h2>
    @endif

    @if(($data['items'] ?? false) && count($data['items']) > 0)
        <div x-data="{ open: null }" class="space-y-4">
            @foreach($data['items'] as $index => $item)
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <button @click="open = open === {{ $index }} ? null : {{ $index }}"
                            class="w-full flex items-center justify-between px-6 py-4 text-left bg-gray-50 hover:bg-gray-100 transition">
                        <span class="font-medium text-gray-900">{{ $item['title'] ?? '' }}</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform"
                             :class="{ 'rotate-180': open === {{ $index }} }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="open === {{ $index }}"
                         x-collapse
                         class="px-6 py-4 text-gray-600">
                        {{ $item['content'] ?? '' }}
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
