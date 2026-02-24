<div class="space-y-4">
    {{-- Title --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Title (Optional)</label>
        <input type="text" x-model="block.data.title"
            @input="updateHiddenInput()"
            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            placeholder="Important note">
    </div>

    {{-- Content with Rich Text Editor --}}
    @include('admin.projects.partials.blocks.partials.richtext-editor', [
        'field' => 'content',
        'label' => 'Content'
    ])

    {{-- Style --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Style</label>
        <div class="flex gap-2 flex-wrap">
            <template x-for="style in ['info', 'warning', 'success', 'error']">
                <button type="button"
                    @click="block.data.style = style; updateHiddenInput()"
                    :class="{
                        'bg-blue-500 text-white': block.data.style === style && style === 'info',
                        'bg-yellow-500 text-white': block.data.style === style && style === 'warning',
                        'bg-green-500 text-white': block.data.style === style && style === 'success',
                        'bg-red-500 text-white': block.data.style === style && style === 'error',
                        'bg-gray-100 text-gray-700 hover:bg-gray-200': block.data.style !== style
                    }"
                    class="px-4 py-2 rounded text-sm font-medium capitalize transition">
                    <span x-text="style"></span>
                </button>
            </template>
        </div>
    </div>

    {{-- Icon (Optional) --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Icon (Optional)</label>
        <select x-model="block.data.icon"
            @change="updateHiddenInput()"
            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="">No Icon</option>
            <option value="info">ℹ️ Info</option>
            <option value="warning">⚠️ Warning</option>
            <option value="check">✅ Check</option>
            <option value="star">⭐ Star</option>
            <option value="lightbulb">💡 Lightbulb</option>
        </select>
    </div>
</div>
