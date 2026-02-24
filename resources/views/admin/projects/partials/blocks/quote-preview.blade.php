<div class="p-6 bg-gray-50">
    <blockquote class="border-l-4 border-blue-500 pl-4">
        <p class="text-lg text-gray-700 italic" x-text="block.data.quote || 'Quote text here...'"></p>
        <footer class="mt-3 flex items-center gap-3">
            <template x-if="block.data.image">
                <img :src="'/storage/' + block.data.image" class="w-10 h-10 rounded-full object-cover">
            </template>
            <div>
                <cite class="not-italic font-medium text-gray-900" x-text="block.data.author || 'Author Name'"></cite>
                <p class="text-sm text-gray-500" x-text="block.data.role || 'Role / Title'"></p>
            </div>
        </footer>
    </blockquote>
</div>
