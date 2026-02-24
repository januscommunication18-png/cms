<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Video URL</label>
        <input type="url" x-model="block.data.url" @input="updateHiddenInput()"
            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            placeholder="https://youtube.com/watch?v=... or https://vimeo.com/...">
        <p class="text-xs text-gray-500 mt-1">Supports YouTube and Vimeo URLs</p>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Caption (optional)</label>
        <input type="text" x-model="block.data.caption" @input="updateHiddenInput()"
            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            placeholder="Video caption or description">
    </div>
</div>
