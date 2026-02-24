<div class="p-6 bg-gray-900">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <template x-for="(item, idx) in block.data.items" :key="idx">
            <div class="text-center">
                <div class="text-3xl font-bold text-white" x-text="item.value || '0'"></div>
                <div class="text-sm text-gray-400 mt-1" x-text="item.label || 'Label'"></div>
            </div>
        </template>
    </div>
</div>
