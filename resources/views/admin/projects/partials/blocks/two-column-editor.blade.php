<div class="space-y-4">
    {{-- Layout Settings --}}
    <div class="p-4 bg-gray-50 rounded-lg">
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs text-gray-500 mb-1">Column Layout</label>
                <select x-model="block.data.layout"
                    @change="updateHiddenInput()"
                    class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="50-50">50% / 50%</option>
                    <option value="60-40">60% / 40%</option>
                    <option value="40-60">40% / 60%</option>
                    <option value="70-30">70% / 30%</option>
                    <option value="30-70">30% / 70%</option>
                </select>
            </div>
            <div>
                <label class="block text-xs text-gray-500 mb-1">Vertical Alignment</label>
                <select x-model="block.data.vertical_align"
                    @change="updateHiddenInput()"
                    class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="top">Top</option>
                    <option value="center">Center</option>
                    <option value="bottom">Bottom</option>
                </select>
            </div>
        </div>
        {{-- Card Style Toggle --}}
        <label class="flex items-center gap-3 cursor-pointer">
            <input type="checkbox"
                   x-model="block.data.card_style"
                   @change="updateHiddenInput()"
                   class="w-4 h-4 text-blue-500 border-gray-300 rounded focus:ring-blue-500">
            <span class="text-sm text-gray-700">Card Style</span>
            <span class="text-xs text-gray-400">(adds background & padding to both columns)</span>
        </label>
    </div>

    {{-- Left Column --}}
    <div class="border border-gray-200 rounded-lg overflow-hidden">
        <div class="bg-blue-50 px-4 py-2 border-b border-gray-200">
            <h4 class="text-sm font-medium text-blue-800">Left Column</h4>
        </div>
        <div class="p-4 space-y-4">
            {{-- Left Column Colors --}}
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Background Color</label>
                    <div class="flex items-center gap-1">
                        <input type="color"
                            x-model="block.data.left_bg_color"
                            @input="updateHiddenInput()"
                            class="w-8 h-8 rounded cursor-pointer border border-gray-300">
                        <input type="text"
                            x-model="block.data.left_bg_color"
                            @input="updateHiddenInput()"
                            class="flex-1 text-xs border-gray-300 rounded-md shadow-sm"
                            placeholder="#ffffff">
                    </div>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Text Color</label>
                    <div class="flex items-center gap-1">
                        <input type="color"
                            x-model="block.data.left_text_color"
                            @input="updateHiddenInput()"
                            class="w-8 h-8 rounded cursor-pointer border border-gray-300">
                        <input type="text"
                            x-model="block.data.left_text_color"
                            @input="updateHiddenInput()"
                            class="flex-1 text-xs border-gray-300 rounded-md shadow-sm"
                            placeholder="#000000">
                    </div>
                </div>
            </div>

            {{-- Left Column Padding --}}
            <div>
                <label class="block text-xs text-gray-500 mb-2">Padding (px)</label>
                <div class="grid grid-cols-4 gap-2">
                    <div>
                        <label class="block text-[10px] text-gray-400 mb-1 text-center">Top</label>
                        <input type="number" min="0" max="100"
                            x-model.number="block.data.left_padding_top"
                            @input="updateHiddenInput()"
                            class="w-full text-xs text-center border-gray-300 rounded-md shadow-sm"
                            placeholder="0">
                    </div>
                    <div>
                        <label class="block text-[10px] text-gray-400 mb-1 text-center">Right</label>
                        <input type="number" min="0" max="100"
                            x-model.number="block.data.left_padding_right"
                            @input="updateHiddenInput()"
                            class="w-full text-xs text-center border-gray-300 rounded-md shadow-sm"
                            placeholder="0">
                    </div>
                    <div>
                        <label class="block text-[10px] text-gray-400 mb-1 text-center">Bottom</label>
                        <input type="number" min="0" max="100"
                            x-model.number="block.data.left_padding_bottom"
                            @input="updateHiddenInput()"
                            class="w-full text-xs text-center border-gray-300 rounded-md shadow-sm"
                            placeholder="0">
                    </div>
                    <div>
                        <label class="block text-[10px] text-gray-400 mb-1 text-center">Left</label>
                        <input type="number" min="0" max="100"
                            x-model.number="block.data.left_padding_left"
                            @input="updateHiddenInput()"
                            class="w-full text-xs text-center border-gray-300 rounded-md shadow-sm"
                            placeholder="0">
                    </div>
                </div>
            </div>

            {{-- Left Content --}}
            @include('admin.projects.partials.blocks.partials.richtext-editor', [
                'field' => 'left_content',
                'label' => 'Content'
            ])
        </div>
    </div>

    {{-- Right Column --}}
    <div class="border border-gray-200 rounded-lg overflow-hidden">
        <div class="bg-green-50 px-4 py-2 border-b border-gray-200">
            <h4 class="text-sm font-medium text-green-800">Right Column</h4>
        </div>
        <div class="p-4 space-y-4">
            {{-- Right Column Colors --}}
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Background Color</label>
                    <div class="flex items-center gap-1">
                        <input type="color"
                            x-model="block.data.right_bg_color"
                            @input="updateHiddenInput()"
                            class="w-8 h-8 rounded cursor-pointer border border-gray-300">
                        <input type="text"
                            x-model="block.data.right_bg_color"
                            @input="updateHiddenInput()"
                            class="flex-1 text-xs border-gray-300 rounded-md shadow-sm"
                            placeholder="#ffffff">
                    </div>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Text Color</label>
                    <div class="flex items-center gap-1">
                        <input type="color"
                            x-model="block.data.right_text_color"
                            @input="updateHiddenInput()"
                            class="w-8 h-8 rounded cursor-pointer border border-gray-300">
                        <input type="text"
                            x-model="block.data.right_text_color"
                            @input="updateHiddenInput()"
                            class="flex-1 text-xs border-gray-300 rounded-md shadow-sm"
                            placeholder="#000000">
                    </div>
                </div>
            </div>

            {{-- Right Column Padding --}}
            <div>
                <label class="block text-xs text-gray-500 mb-2">Padding (px)</label>
                <div class="grid grid-cols-4 gap-2">
                    <div>
                        <label class="block text-[10px] text-gray-400 mb-1 text-center">Top</label>
                        <input type="number" min="0" max="100"
                            x-model.number="block.data.right_padding_top"
                            @input="updateHiddenInput()"
                            class="w-full text-xs text-center border-gray-300 rounded-md shadow-sm"
                            placeholder="0">
                    </div>
                    <div>
                        <label class="block text-[10px] text-gray-400 mb-1 text-center">Right</label>
                        <input type="number" min="0" max="100"
                            x-model.number="block.data.right_padding_right"
                            @input="updateHiddenInput()"
                            class="w-full text-xs text-center border-gray-300 rounded-md shadow-sm"
                            placeholder="0">
                    </div>
                    <div>
                        <label class="block text-[10px] text-gray-400 mb-1 text-center">Bottom</label>
                        <input type="number" min="0" max="100"
                            x-model.number="block.data.right_padding_bottom"
                            @input="updateHiddenInput()"
                            class="w-full text-xs text-center border-gray-300 rounded-md shadow-sm"
                            placeholder="0">
                    </div>
                    <div>
                        <label class="block text-[10px] text-gray-400 mb-1 text-center">Left</label>
                        <input type="number" min="0" max="100"
                            x-model.number="block.data.right_padding_left"
                            @input="updateHiddenInput()"
                            class="w-full text-xs text-center border-gray-300 rounded-md shadow-sm"
                            placeholder="0">
                    </div>
                </div>
            </div>

            {{-- Right Image --}}
            <div>
                <label class="block text-xs text-gray-500 mb-1">Image (optional)</label>
                <input type="file" accept="image/*"
                    @change="uploadImage($event, index, 'right_image')"
                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <template x-if="block.data.right_image">
                    <div class="mt-2 relative inline-block">
                        <img :src="getImageUrl(block.data.right_image)" class="h-20 rounded">
                        <button type="button" @click="block.data.right_image = ''; updateHiddenInput()"
                            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 text-xs">×</button>
                    </div>
                </template>
            </div>

            {{-- Right Content --}}
            @include('admin.projects.partials.blocks.partials.richtext-editor', [
                'field' => 'right_content',
                'label' => 'Or Text Content'
            ])
        </div>
    </div>
</div>
