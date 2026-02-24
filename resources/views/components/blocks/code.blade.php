@props(['data'])

<div class="max-w-6xl mx-auto px-4 md:px-6">
    <div class="bg-gray-900 rounded-lg overflow-hidden shadow-lg">
        @if($data['filename'] ?? false)
            <div class="bg-gray-800 px-4 py-2 text-sm text-gray-400 border-b border-gray-700">
                {{ $data['filename'] }}
            </div>
        @endif

        <pre class="p-4 overflow-x-auto"><code class="text-sm text-gray-300 font-mono">{{ $data['code'] ?? '' }}</code></pre>
    </div>

    @if($data['caption'] ?? false)
        <p class="mt-4 text-center text-gray-500 text-sm">
            {{ $data['caption'] }}
        </p>
    @endif
</div>
