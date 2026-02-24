@props(['data'])

<div class="max-w-6xl mx-auto px-4 md:px-6">
    @if($data['heading'] ?? false)
        <h2 class="text-3xl md:text-4xl font-semibold text-gray-900 text-center mb-12">
            {{ $data['heading'] }}
        </h2>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @if($data['before_image'] ?? false)
            <div class="relative">
                <span class="absolute top-4 left-4 bg-black/70 text-white px-3 py-1 rounded text-sm font-medium">
                    Before
                </span>
                <img src="{{ asset('storage/' . $data['before_image']) }}"
                     alt="Before"
                     class="w-full rounded-lg shadow-lg">
            </div>
        @endif

        @if($data['after_image'] ?? false)
            <div class="relative">
                <span class="absolute top-4 left-4 bg-[#00959f] text-white px-3 py-1 rounded text-sm font-medium">
                    After
                </span>
                <img src="{{ asset('storage/' . $data['after_image']) }}"
                     alt="After"
                     class="w-full rounded-lg shadow-lg">
            </div>
        @endif
    </div>

    @if($data['caption'] ?? false)
        <p class="mt-6 text-center text-gray-500">
            {{ $data['caption'] }}
        </p>
    @endif
</div>
