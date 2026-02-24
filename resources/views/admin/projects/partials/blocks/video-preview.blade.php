<div class="p-4">
    <template x-if="block.data.url">
        <div class="space-y-2">
            <div class="aspect-video bg-gray-900 rounded flex items-center justify-center">
                <div class="text-center text-white">
                    <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm" x-text="block.data.url"></span>
                </div>
            </div>
            <p class="text-center text-gray-500 text-xs" x-text="block.data.caption"></p>
        </div>
    </template>
    <template x-if="!block.data.url">
        <div class="text-center text-gray-400 py-8">Enter a video URL</div>
    </template>
</div>
