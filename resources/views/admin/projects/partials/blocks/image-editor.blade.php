<div class="space-y-4">
    {{-- Image Upload --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
        <div class="space-y-3">
            <template x-if="block.data.image">
                <div class="relative inline-block">
                    <img :src="'/storage/' + block.data.image" class="max-w-full h-40 object-cover rounded">
                    <button type="button" @click="block.data.image = ''"
                        class="absolute top-2 right-2 p-1 bg-red-500 text-white rounded-full hover:bg-red-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </template>
            <input type="file" accept="image/*"
                @change="uploadImage($event, index, 'image')"
                class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        </div>
    </div>

    {{-- Caption --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Caption</label>
        <input type="text" x-model="block.data.caption"
            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            placeholder="Image caption (optional)">
    </div>

    {{-- Alt Text --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Alt Text</label>
        <input type="text" x-model="block.data.alt_text"
            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            placeholder="Describe the image for accessibility">
    </div>

    {{-- Size --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Display Size</label>
        <div class="flex gap-2">
            <template x-for="size in ['full', 'large', 'medium']">
                <button type="button"
                    @click="block.data.size = size"
                    :class="block.data.size === size ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-4 py-2 rounded text-sm font-medium capitalize transition">
                    <span x-text="size"></span>
                </button>
            </template>
        </div>
    </div>
</div>
