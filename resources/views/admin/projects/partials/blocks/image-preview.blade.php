<div class="p-4">
    <template x-if="block.data.image">
        <figure class="text-center"
            :class="{
                'max-w-full': block.data.size === 'full',
                'max-w-3xl mx-auto': block.data.size === 'large',
                'max-w-xl mx-auto': block.data.size === 'medium'
            }">
            <img :src="'/storage/' + block.data.image"
                 :alt="block.data.alt_text || ''"
                 class="w-full rounded-lg shadow">
            <figcaption x-show="block.data.caption" class="mt-2 text-sm text-gray-500" x-text="block.data.caption"></figcaption>
        </figure>
    </template>
    <template x-if="!block.data.image">
        <div class="flex items-center justify-center h-32 bg-gray-100 rounded-lg text-gray-400">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
    </template>
</div>
