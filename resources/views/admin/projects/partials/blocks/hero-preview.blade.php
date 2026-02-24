<div class="relative h-48 overflow-hidden"
     :class="block.data.layout === 'full-bg-fixed-image' ? 'p-3' : ''"
     :style="block.data.layout === 'full-bg-fixed-image' ? 'background-color: ' + (block.data.bg_color || '#f3f4f6') : ''">

    <div class="relative h-full overflow-hidden"
         :class="block.data.layout === 'fixed-width' || block.data.layout === 'full-bg-fixed-image' ? 'rounded-xl' : ''">
        <template x-if="block.data.image">
            <img :src="'/storage/' + block.data.image" class="absolute inset-0 w-full h-full object-cover">
        </template>
        <template x-if="!block.data.image">
            <div class="absolute inset-0 bg-gray-300 flex items-center justify-center text-gray-400">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        </template>

        {{-- Overlay --}}
        <div class="absolute inset-0"
             :style="'background-color: ' + (block.data.overlay_color || '#000000') + '; opacity: ' + ((block.data.overlay_opacity || 40) / 100)"></div>

        {{-- Content --}}
        <div class="relative z-10 flex items-center justify-center h-full px-4"
             :class="'text-' + (block.data.text_alignment || 'center')">
            <div class="max-w-2xl">
                <h2 class="text-2xl font-bold text-white mb-2" x-text="block.data.title || 'Hero Title'"></h2>
                <p class="text-white/90 text-sm" x-html="block.data.subtitle || 'Subtitle text'"></p>
            </div>
        </div>
    </div>

    {{-- Layout Badge --}}
    <div class="absolute top-2 left-2 z-20 px-2 py-1 bg-black/50 rounded text-xs text-white">
        <span x-text="block.data.layout === 'fixed-width' ? 'Fixed Width' : (block.data.layout === 'full-bg-fixed-image' ? 'Full BG + Fixed' : 'Full Width')"></span>
    </div>
</div>
