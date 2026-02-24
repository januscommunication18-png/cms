@props(['data'])

<div class="max-w-6xl mx-auto px-4 md:px-6">
    @if(($data['images'] ?? false) && count($data['images']) > 0)
        <div x-data="{ current: 0, images: {{ json_encode($data['images']) }} }"
             class="relative">
            <div class="overflow-hidden rounded-lg shadow-lg">
                <template x-for="(image, index) in images" :key="index">
                    <div x-show="current === index"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         class="aspect-video">
                        <img :src="'/storage/' + (image.path || image)"
                             :alt="image.caption || ''"
                             class="w-full h-full object-cover">
                    </div>
                </template>
            </div>

            <button @click="current = current > 0 ? current - 1 : images.length - 1"
                    class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-3 rounded-full transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>

            <button @click="current = current < images.length - 1 ? current + 1 : 0"
                    class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-3 rounded-full transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
                <template x-for="(image, index) in images" :key="'dot-' + index">
                    <button @click="current = index"
                            :class="current === index ? 'bg-white' : 'bg-white/50'"
                            class="w-2 h-2 rounded-full transition"></button>
                </template>
            </div>
        </div>
    @endif
</div>
