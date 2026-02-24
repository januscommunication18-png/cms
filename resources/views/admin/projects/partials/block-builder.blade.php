<div x-data="blockBuilder({{ json_encode($project->content_blocks ?? ['blocks' => [], 'version' => 1]) }}, {{ json_encode($blockTypes) }})"
     x-init="init()"
     class="block-builder">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Left Column: Form --}}
        <div class="space-y-6">
            {{-- Block Type Selector Card --}}
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4">
                <label class="block text-sm font-medium text-gray-700 mb-3">Add Content Block</label>
                <div class="grid grid-cols-4 gap-2">
                    <template x-for="(info, type) in blockTypes" :key="type">
                        <button type="button"
                            @click="addBlock(type)"
                            class="flex flex-col items-center p-2 text-xs bg-gray-50 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition group">
                            <span class="text-gray-500 group-hover:text-blue-600 text-center leading-tight" x-text="info.name"></span>
                        </button>
                    </template>
                </div>
            </div>

            {{-- Content Blocks Editor Card --}}
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                <div class="px-4 py-3 border-b border-gray-200 bg-gray-50 rounded-t-lg">
                    <h3 class="text-lg font-medium text-gray-900">Content Blocks</h3>
                    <p class="text-sm text-gray-500">Drag blocks to reorder. Click to edit.</p>
                </div>

                <div x-ref="blockList" class="p-4 space-y-3 min-h-[200px]">
                    <template x-if="blocks.length === 0">
                        <div class="text-center py-12 text-gray-400 border-2 border-dashed border-gray-200 rounded-lg">
                            <svg class="w-12 h-12 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            <p class="font-medium">No blocks added yet</p>
                            <p class="text-sm">Click a block type above to add content</p>
                        </div>
                    </template>

                    <template x-for="(block, index) in blocks" :key="block.id">
                        <div class="block-item bg-white border border-gray-200 rounded-lg shadow-sm"
                             :class="{ 'ring-2 ring-blue-500': selectedBlockIndex === index }"
                             draggable="true"
                             @dragstart="dragStart($event, index)"
                             @dragend="dragEnd($event)"
                             @dragover.prevent="dragOver($event)"
                             @dragenter="dragEnter($event, index)"
                             @dragleave="dragLeave($event)"
                             @drop="drop($event, index)">

                            {{-- Block Header --}}
                            <div class="flex items-center justify-between px-4 py-3 bg-gray-50 rounded-t-lg border-b cursor-move"
                                 @click="selectBlock(index)">
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/>
                                    </svg>
                                    <span class="font-medium text-gray-700 text-sm" x-text="blockTypes[block.type]?.name || block.type"></span>
                                    <span class="text-xs text-gray-400" x-text="'#' + (index + 1)"></span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <button type="button" @click.stop="toggleBlock(index)"
                                        class="p-1.5 text-gray-400 hover:text-blue-500 rounded hover:bg-blue-50">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                :d="!block.collapsed ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7'"/>
                                        </svg>
                                    </button>
                                    <button type="button" @click.stop="moveBlockUp(index)"
                                        class="p-1.5 text-gray-400 hover:text-blue-500 rounded hover:bg-blue-50"
                                        :class="{ 'opacity-30 cursor-not-allowed': index === 0 }">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                                        </svg>
                                    </button>
                                    <button type="button" @click.stop="moveBlockDown(index)"
                                        class="p-1.5 text-gray-400 hover:text-blue-500 rounded hover:bg-blue-50"
                                        :class="{ 'opacity-30 cursor-not-allowed': index === blocks.length - 1 }">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </button>
                                    <button type="button" @click.stop="duplicateBlock(index)"
                                        class="p-1.5 text-gray-400 hover:text-green-500 rounded hover:bg-green-50">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                    </button>
                                    <button type="button" @click.stop="removeBlock(index)"
                                        class="p-1.5 text-gray-400 hover:text-red-500 rounded hover:bg-red-50">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            {{-- Block Editor (Collapsible) --}}
                            <div x-show="!block.collapsed" x-collapse class="p-4 space-y-4 border-t">
                                {{-- Hero Block --}}
                                <template x-if="block.type === 'hero'">
                                    @include('admin.projects.partials.blocks.hero-editor')
                                </template>

                                {{-- Text Block --}}
                                <template x-if="block.type === 'text'">
                                    @include('admin.projects.partials.blocks.text-editor')
                                </template>

                                {{-- Image Block --}}
                                <template x-if="block.type === 'image'">
                                    @include('admin.projects.partials.blocks.image-editor')
                                </template>

                                {{-- Two Column Block --}}
                                <template x-if="block.type === 'two_column'">
                                    @include('admin.projects.partials.blocks.two-column-editor')
                                </template>

                                {{-- Stats Block --}}
                                <template x-if="block.type === 'stats'">
                                    @include('admin.projects.partials.blocks.stats-editor')
                                </template>

                                {{-- Quote Block --}}
                                <template x-if="block.type === 'quote'">
                                    @include('admin.projects.partials.blocks.quote-editor')
                                </template>

                                {{-- Gallery Block --}}
                                <template x-if="block.type === 'gallery'">
                                    @include('admin.projects.partials.blocks.gallery-editor')
                                </template>

                                {{-- Video Block --}}
                                <template x-if="block.type === 'video'">
                                    @include('admin.projects.partials.blocks.video-editor')
                                </template>

                                {{-- Callout Block --}}
                                <template x-if="block.type === 'callout'">
                                    @include('admin.projects.partials.blocks.callout-editor')
                                </template>

                                {{-- CTA Block --}}
                                <template x-if="block.type === 'cta'">
                                    @include('admin.projects.partials.blocks.cta-editor')
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        {{-- Right Column: Preview (Sticky) --}}
        <div class="lg:sticky lg:top-4 lg:self-start">
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                <div class="px-4 py-3 border-b border-gray-200 bg-gray-50 rounded-t-lg flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Preview</h3>
                        <p class="text-sm text-gray-500">Live preview of your content</p>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800" x-text="blocks.length + ' block' + (blocks.length !== 1 ? 's' : '')"></span>
                </div>

                <div class="preview-container max-h-[70vh] overflow-y-auto">
                    <template x-if="blocks.length === 0">
                        <div class="flex items-center justify-center h-64 text-gray-400">
                            <div class="text-center">
                                <svg class="w-12 h-12 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <p>Preview will appear here</p>
                            </div>
                        </div>
                    </template>

                    <template x-for="(block, index) in blocks" :key="block.id + '-preview'">
                        <div class="preview-block border-b border-gray-100 last:border-b-0 cursor-pointer"
                             :class="{ 'ring-2 ring-blue-300 ring-inset': selectedBlockIndex === index }"
                             @click="selectBlock(index)">
                            {{-- Hero Preview --}}
                            <template x-if="block.type === 'hero'">
                                @include('admin.projects.partials.blocks.hero-preview')
                            </template>

                            {{-- Text Preview --}}
                            <template x-if="block.type === 'text'">
                                @include('admin.projects.partials.blocks.text-preview')
                            </template>

                            {{-- Image Preview --}}
                            <template x-if="block.type === 'image'">
                                @include('admin.projects.partials.blocks.image-preview')
                            </template>

                            {{-- Quote Preview --}}
                            <template x-if="block.type === 'quote'">
                                @include('admin.projects.partials.blocks.quote-preview')
                            </template>

                            {{-- Stats Preview --}}
                            <template x-if="block.type === 'stats'">
                                @include('admin.projects.partials.blocks.stats-preview')
                            </template>

                            {{-- CTA Preview --}}
                            <template x-if="block.type === 'cta'">
                                @include('admin.projects.partials.blocks.cta-preview')
                            </template>

                            {{-- Two Column Preview --}}
                            <template x-if="block.type === 'two_column'">
                                @include('admin.projects.partials.blocks.two-column-preview')
                            </template>

                            {{-- Gallery Preview --}}
                            <template x-if="block.type === 'gallery'">
                                @include('admin.projects.partials.blocks.gallery-preview')
                            </template>

                            {{-- Video Preview --}}
                            <template x-if="block.type === 'video'">
                                @include('admin.projects.partials.blocks.video-preview')
                            </template>

                            {{-- Other blocks show placeholder --}}
                            <template x-if="!['hero', 'text', 'image', 'quote', 'stats', 'cta', 'two_column', 'gallery', 'video'].includes(block.type)">
                                <div class="p-4 bg-gray-50 text-center text-gray-500 text-sm">
                                    <span x-text="blockTypes[block.type]?.name || block.type"></span> block preview
                                </div>
                            </template>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    {{-- Hidden input for form submission --}}
    <input type="hidden" name="content_blocks" id="content_blocks_input" :value="getBlocksJson()">
</div>
