<div class="space-y-4">
    {{-- Quote Text with Rich Text Editor --}}
    @include('admin.projects.partials.blocks.partials.richtext-editor', [
        'field' => 'quote',
        'label' => 'Quote'
    ])

    {{-- Author --}}
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Author Name</label>
            <input type="text" x-model="block.data.author"
                @input="updateHiddenInput()"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                placeholder="John Doe">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Role / Title</label>
            <input type="text" x-model="block.data.role"
                @input="updateHiddenInput()"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                placeholder="CEO, Company">
        </div>
    </div>

    {{-- Author Image --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Author Image (Optional)</label>
        <div class="flex items-center gap-4">
            <template x-if="block.data.image">
                <div class="relative">
                    <img :src="'/storage/' + block.data.image" class="w-12 h-12 rounded-full object-cover">
                    <button type="button" @click="block.data.image = ''; updateHiddenInput()"
                        class="absolute -top-1 -right-1 p-0.5 bg-red-500 text-white rounded-full">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
</div>
