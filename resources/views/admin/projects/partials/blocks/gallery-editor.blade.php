<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Gallery Images</label>
        <input type="file" accept="image/*" multiple
            @change="uploadGalleryImage($event, index)"
            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
    </div>

    <template x-if="block.data.images && block.data.images.length > 0">
        <div class="grid grid-cols-3 gap-2">
            <template x-for="(image, imgIndex) in block.data.images" :key="imgIndex">
                <div class="relative group">
                    <img :src="getImageUrl(image.path || image)" class="w-full h-24 object-cover rounded">
                    <button type="button" @click="removeGalleryImage(index, imgIndex)"
                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 text-xs opacity-0 group-hover:opacity-100 transition">×</button>
                </div>
            </template>
        </div>
    </template>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Columns</label>
        <select x-model="block.data.columns" @change="updateHiddenInput()"
            class="w-32 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="2">2 Columns</option>
            <option value="3">3 Columns</option>
            <option value="4">4 Columns</option>
        </select>
    </div>
</div>
