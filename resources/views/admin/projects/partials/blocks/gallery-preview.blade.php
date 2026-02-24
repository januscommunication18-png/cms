<div class="p-4">
    <template x-if="block.data.images && block.data.images.length > 0">
        <div class="grid grid-cols-3 gap-2">
            <template x-for="(image, imgIndex) in block.data.images" :key="imgIndex">
                <img :src="getImageUrl(image.path || image)" class="w-full h-20 object-cover rounded">
            </template>
        </div>
    </template>
    <template x-if="!block.data.images || block.data.images.length === 0">
        <div class="text-center text-gray-400 py-8">No images added yet</div>
    </template>
</div>
