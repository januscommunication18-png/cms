<div class="space-y-4">
    <div class="flex items-center justify-between">
        <label class="block text-sm font-medium text-gray-700">Stats Items</label>
        <button type="button"
            @click="if (!block.data.items) block.data.items = []; block.data.items.push({ value: '', label: '' })"
            class="text-sm text-blue-600 hover:text-blue-800">
            + Add Stat
        </button>
    </div>

    <div class="space-y-3">
        <template x-for="(item, idx) in block.data.items" :key="idx">
            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                <div class="flex-1 grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Value</label>
                        <input type="text" x-model="item.value"
                            class="w-full border-gray-300 rounded-md shadow-sm text-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="+50%">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Label</label>
                        <input type="text" x-model="item.label"
                            class="w-full border-gray-300 rounded-md shadow-sm text-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Increase in sales">
                    </div>
                </div>
                <button type="button"
                    @click="block.data.items.splice(idx, 1)"
                    class="p-1 text-gray-400 hover:text-red-500"
                    x-show="block.data.items.length > 1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </template>
    </div>
</div>
