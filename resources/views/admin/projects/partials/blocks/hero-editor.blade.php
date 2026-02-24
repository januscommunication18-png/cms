<div class="space-y-4">
    {{-- Layout Style --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Layout Style</label>
        <div class="grid grid-cols-1 gap-2">
            <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer transition"
                   :class="block.data.layout === 'full-width' || !block.data.layout ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:bg-gray-50'"
                   @click="block.data.layout = 'full-width'; updateHiddenInput()">
                <input type="radio" name="hero_layout" value="full-width" x-model="block.data.layout" class="hidden">
                <div class="w-12 h-8 bg-gray-300 rounded flex-shrink-0"></div>
                <div>
                    <span class="text-sm font-medium text-gray-900">100% Full Width (Background)</span>
                    <p class="text-xs text-gray-500">Image spans entire screen width</p>
                </div>
            </label>
            <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer transition"
                   :class="block.data.layout === 'fixed-width' ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:bg-gray-50'"
                   @click="block.data.layout = 'fixed-width'; updateHiddenInput()">
                <input type="radio" name="hero_layout" value="fixed-width" x-model="block.data.layout" class="hidden">
                <div class="w-12 h-8 bg-white border-2 border-gray-300 rounded flex-shrink-0 flex items-center justify-center">
                    <div class="w-8 h-5 bg-gray-300 rounded"></div>
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-900">Fixed Width (Image)</span>
                    <p class="text-xs text-gray-500">Image contained within page width</p>
                </div>
            </label>
            <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer transition"
                   :class="block.data.layout === 'full-bg-fixed-image' ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:bg-gray-50'"
                   @click="block.data.layout = 'full-bg-fixed-image'; updateHiddenInput()">
                <input type="radio" name="hero_layout" value="full-bg-fixed-image" x-model="block.data.layout" class="hidden">
                <div class="w-12 h-8 bg-gray-200 rounded flex-shrink-0 flex items-center justify-center">
                    <div class="w-8 h-5 bg-gray-400 rounded"></div>
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-900">Full Width Background + Fixed Image</span>
                    <p class="text-xs text-gray-500">Background color spans full width, image centered</p>
                </div>
            </label>
        </div>
    </div>

    {{-- Background Color (for full-bg-fixed-image layout) --}}
    <div x-show="block.data.layout === 'full-bg-fixed-image'" x-collapse>
        <label class="block text-sm font-medium text-gray-700 mb-1">Background Color</label>
        <div class="flex items-center gap-2">
            <input type="color" x-model="block.data.bg_color"
                @input="updateHiddenInput()"
                class="w-10 h-10 rounded cursor-pointer border border-gray-300">
            <input type="text" x-model="block.data.bg_color"
                @input="updateHiddenInput()"
                class="flex-1 border-gray-300 rounded-md shadow-sm text-sm"
                placeholder="#f3f4f6">
        </div>
    </div>

    {{-- Image Upload --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Hero Image</label>
        <div class="flex items-start gap-4">
            <div x-show="block.data.image" class="relative w-40 h-24 rounded overflow-hidden bg-gray-100">
                <img :src="'/storage/' + block.data.image" class="w-full h-full object-cover">
                <button type="button" @click="block.data.image = ''; updateHiddenInput()"
                    class="absolute top-1 right-1 p-1 bg-red-500 text-white rounded-full hover:bg-red-600">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="flex-1">
                <input type="file" accept="image/*"
                    @change="uploadImage($event, index, 'image')"
                    class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <p class="text-xs text-gray-500 mt-1">Recommended: 1920x1080 or larger</p>
            </div>
        </div>
    </div>

    {{-- Title --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
        <input type="text" x-model="block.data.title"
            @input="updateHiddenInput()"
            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            placeholder="Enter hero title">
    </div>

    {{-- Subtitle with Rich Text Editor --}}
    @include('admin.projects.partials.blocks.partials.richtext-editor', [
        'field' => 'subtitle',
        'label' => 'Subtitle'
    ])

    {{-- Overlay Settings --}}
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Overlay Color</label>
            <input type="color" x-model="block.data.overlay_color"
                @input="updateHiddenInput()"
                class="w-full h-10 rounded cursor-pointer border border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Overlay Opacity: <span x-text="block.data.overlay_opacity + '%'"></span>
            </label>
            <input type="range" x-model="block.data.overlay_opacity" min="0" max="100"
                @input="updateHiddenInput()"
                class="w-full">
        </div>
    </div>

    {{-- Text Alignment --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Text Alignment</label>
        <div class="flex gap-2">
            <template x-for="align in ['left', 'center', 'right']">
                <button type="button"
                    @click="block.data.text_alignment = align; updateHiddenInput()"
                    :class="block.data.text_alignment === align ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-4 py-2 rounded text-sm font-medium capitalize transition">
                    <span x-text="align"></span>
                </button>
            </template>
        </div>
    </div>
</div>
