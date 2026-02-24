<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
        <input type="text" x-model="block.data.title"
            @input="updateHiddenInput()"
            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            placeholder="Ready to get started?">
    </div>

    {{-- Description with Rich Text Editor --}}
    @include('admin.projects.partials.blocks.partials.richtext-editor', [
        'field' => 'description',
        'label' => 'Description'
    ])

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Button Text</label>
            <input type="text" x-model="block.data.button_text"
                @input="updateHiddenInput()"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                placeholder="Get in Touch">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Button URL</label>
            <input type="text" x-model="block.data.button_url"
                @input="updateHiddenInput()"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                placeholder="/contact">
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Button Style</label>
            <select x-model="block.data.style"
                @change="updateHiddenInput()"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="primary">Primary</option>
                <option value="secondary">Secondary</option>
                <option value="outline">Outline</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Background</label>
            <select x-model="block.data.background"
                @change="updateHiddenInput()"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="dark">Dark</option>
                <option value="light">Light</option>
                <option value="brand">Brand</option>
            </select>
        </div>
    </div>
</div>
