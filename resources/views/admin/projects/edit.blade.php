@extends('admin.layouts.admin')

@section('content')
<div x-data="{
        focusMode: false,
        activeTab: 'content',
        ...blockBuilder({{ json_encode($project->content_blocks ?? ['blocks' => [], 'version' => 1]) }}, {{ json_encode($blockTypes) }})
     }"
     x-init="init()"
     :class="{ 'focus-mode': focusMode }"
     class="block-builder-wrapper">

    {{-- Sticky Header --}}
    <div class="sticky top-0 z-40 -mx-4 px-4 py-3 bg-gray-100 border-b border-gray-200"
         :class="focusMode ? 'bg-white shadow-md mb-4' : 'mb-6'">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.projects.index') }}"
                   class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-200 rounded-lg transition"
                   :class="{ 'hidden': focusMode }">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-xl font-bold text-gray-900">{{ $project->title }}</h1>
                    <p class="text-sm text-gray-500">Editing project</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                {{-- Focus Mode Toggle --}}
                <button type="button"
                        @click="focusMode = !focusMode"
                        class="flex items-center gap-2 px-3 py-2 text-sm rounded-lg transition"
                        :class="focusMode ? 'bg-blue-500 text-white' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-300'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              :d="focusMode ? 'M6 18L18 6M6 6l12 12' : 'M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4'"/>
                    </svg>
                    <span x-text="focusMode ? 'Exit Focus' : 'Focus Mode'"></span>
                </button>

                {{-- Preview Link --}}
                <a href="{{ route('project.show', $project->slug) }}" target="_blank"
                   class="flex items-center gap-2 px-3 py-2 text-sm bg-white text-gray-600 hover:bg-gray-50 border border-gray-300 rounded-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <span class="hidden sm:inline">Preview</span>
                </a>

                {{-- Save Button --}}
                <button type="submit" form="project-form"
                        class="flex items-center gap-2 px-4 py-2 text-sm bg-blue-500 text-white hover:bg-blue-600 rounded-lg transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Save Changes
                </button>
            </div>
        </div>
    </div>

    <form id="project-form" action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="content_blocks" id="content_blocks_input" :value="getBlocksJson()">

        <div class="grid gap-6" :class="focusMode ? 'grid-cols-1 lg:grid-cols-2 max-w-[1600px] mx-auto' : 'grid-cols-1 xl:grid-cols-3'">

            {{-- Main Content Area (Editor) --}}
            <div :class="focusMode ? '' : 'xl:col-span-2'" class="space-y-6">

                {{-- Tabs --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="flex border-b border-gray-200">
                        <button type="button" @click="activeTab = 'content'"
                                class="flex-1 px-6 py-4 text-sm font-medium transition relative"
                                :class="activeTab === 'content' ? 'text-blue-600 bg-blue-50/50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50'">
                            <span class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                                Content Blocks
                                <span class="px-2 py-0.5 text-xs rounded-full"
                                      :class="activeTab === 'content' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600'"
                                      x-text="blocks.length"></span>
                            </span>
                            <div x-show="activeTab === 'content'" class="absolute bottom-0 left-0 right-0 h-0.5 bg-blue-500"></div>
                        </button>
                        <button type="button" @click="activeTab = 'settings'"
                                class="flex-1 px-6 py-4 text-sm font-medium transition relative"
                                :class="activeTab === 'settings' ? 'text-blue-600 bg-blue-50/50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50'">
                            <span class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Project Settings
                            </span>
                            <div x-show="activeTab === 'settings'" class="absolute bottom-0 left-0 right-0 h-0.5 bg-blue-500"></div>
                        </button>
                    </div>

                    {{-- Content Tab --}}
                    <div x-show="activeTab === 'content'" class="p-6">
                        {{-- Add Block Buttons --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Add Content Block</label>
                            <div class="grid grid-cols-4 sm:grid-cols-6 lg:grid-cols-8 gap-2">
                                <template x-for="(info, type) in blockTypes" :key="type">
                                    <button type="button"
                                        @click="addBlock(type)"
                                        class="flex flex-col items-center p-3 text-xs bg-gray-50 border border-gray-200 rounded-xl hover:bg-blue-50 hover:border-blue-300 hover:shadow-sm transition group">
                                        <span class="text-gray-600 group-hover:text-blue-600 text-center leading-tight font-medium" x-text="info.name"></span>
                                    </button>
                                </template>
                            </div>
                        </div>

                        {{-- Blocks List --}}
                        <div x-ref="blockList" class="space-y-4">
                            <template x-if="blocks.length === 0">
                                <div class="text-center py-16 text-gray-400 border-2 border-dashed border-gray-200 rounded-xl bg-gray-50/50">
                                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                    <p class="font-medium text-gray-500">No content blocks yet</p>
                                    <p class="text-sm mt-1">Click a block type above to start building</p>
                                </div>
                            </template>

                            <template x-for="(block, index) in blocks" :key="block.id">
                                <div class="block-item bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden transition-all duration-200"
                                     :class="{ 'ring-2 ring-blue-500 shadow-lg': selectedBlockIndex === index }"
                                     draggable="true"
                                     @dragstart="dragStart($event, index)"
                                     @dragend="dragEnd($event)"
                                     @dragover.prevent="dragOver($event)"
                                     @dragenter="dragEnter($event, index)"
                                     @dragleave="dragLeave($event)"
                                     @drop="drop($event, index)">

                                    {{-- Block Header --}}
                                    <div class="flex items-center justify-between px-4 py-3 bg-gradient-to-r from-gray-50 to-white border-b cursor-pointer"
                                         @click="toggleBlock(index); selectBlock(index)">
                                        <div class="flex items-center gap-3">
                                            {{-- Drag Handle --}}
                                            <div class="p-1.5 bg-gray-100 rounded-lg cursor-grab active:cursor-grabbing" title="Drag to reorder">
                                                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                                    <circle cx="9" cy="6" r="1.5"/>
                                                    <circle cx="15" cy="6" r="1.5"/>
                                                    <circle cx="9" cy="12" r="1.5"/>
                                                    <circle cx="15" cy="12" r="1.5"/>
                                                    <circle cx="9" cy="18" r="1.5"/>
                                                    <circle cx="15" cy="18" r="1.5"/>
                                                </svg>
                                            </div>
                                            <div class="flex items-center gap-2 min-w-0">
                                                <span class="font-medium text-gray-800 text-sm flex-shrink-0" x-text="blockTypes[block.type]?.name || block.type"></span>
                                                <span class="text-xs text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full flex-shrink-0" x-text="'#' + (index + 1)"></span>
                                                <template x-if="block.collapsed && getBlockPreview(block)">
                                                    <span class="text-xs text-gray-500 truncate max-w-[200px] lg:max-w-[350px] border-l border-gray-200 pl-2 ml-1" x-text="getBlockPreview(block)"></span>
                                                </template>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <button type="button" @click.stop="duplicateBlock(index)"
                                                class="p-2 text-gray-400 hover:text-green-500 rounded-lg hover:bg-green-50 transition"
                                                title="Duplicate">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                </svg>
                                            </button>
                                            <button type="button" @click.stop="removeBlock(index)"
                                                class="p-2 text-gray-400 hover:text-red-500 rounded-lg hover:bg-red-50 transition"
                                                title="Delete">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                            {{-- Expand/Collapse chevron --}}
                                            <div class="p-2 text-gray-400">
                                                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': !block.collapsed }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Block Editor --}}
                                    <div x-show="!block.collapsed" x-collapse class="p-5 bg-gray-50/30">
                                        @include('admin.projects.partials.block-editors')
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- Settings Tab --}}
                    <div x-show="activeTab === 'settings'" class="p-6 space-y-6">
                        {{-- Basic Info --}}
                        <div class="space-y-4">
                            <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider">Basic Information</h3>

                            {{-- Project Title --}}
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Project Title *</label>
                                <input type="text" name="title" id="title" required
                                    value="{{ old('title', $project->title) }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            {{-- Short Description --}}
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Short Description</label>
                                <textarea name="description" id="description" rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $project->description) }}</textarea>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                    <select name="category_id" id="category_id"
                                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">No Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $project->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="client_name" class="block text-sm font-medium text-gray-700 mb-1">Client Name</label>
                                    <input type="text" name="client_name" id="client_name" value="{{ old('client_name', $project->client_name) }}"
                                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Client or company name">
                                </div>
                            </div>

                            <div>
                                <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                                <input type="text" name="tags" id="tags" value="{{ old('tags', is_array($project->tags) ? implode(', ', $project->tags) : '') }}"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Mobile App, B2C, Healthcare (comma-separated)">
                            </div>
                        </div>

                        <hr class="border-gray-200">

                        {{-- Appearance --}}
                        <div class="space-y-4">
                            <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider">Appearance</h3>

                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Cover Image</label>
                                @if($project->image)
                                    <div class="mb-3 relative inline-block">
                                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"
                                             class="w-40 h-28 object-cover rounded-lg shadow-sm">
                                    </div>
                                @endif
                                <input type="file" name="image" id="image" accept="image/*"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                            </div>

                            {{-- Banner Image --}}
                            <div x-data="{ useCoverAsBanner: {{ $project->use_cover_as_banner ? 'true' : 'false' }} }">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Banner Image</label>
                                <p class="text-xs text-gray-500 mb-3">This image will be displayed after the project title on the detail page</p>

                                <label class="flex items-center gap-2 mb-3 cursor-pointer">
                                    <input type="checkbox" name="use_cover_as_banner" value="1"
                                           x-model="useCoverAsBanner"
                                           {{ old('use_cover_as_banner', $project->use_cover_as_banner) ? 'checked' : '' }}
                                           class="w-4 h-4 rounded border-gray-300 text-blue-500 focus:ring-blue-500">
                                    <span class="text-sm text-gray-700">Use cover image as banner</span>
                                </label>

                                <div x-show="!useCoverAsBanner" x-collapse>
                                    @if($project->banner_image)
                                        <div class="mb-3 relative inline-block">
                                            <img src="{{ asset('storage/' . $project->banner_image) }}" alt="Banner"
                                                 class="w-full max-w-md h-32 object-cover rounded-lg shadow-sm">
                                        </div>
                                    @endif
                                    <input type="file" name="banner_image" id="banner_image" accept="image/*"
                                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Card Background Color</label>
                                <div class="flex items-center gap-3">
                                    <input type="color" name="background_color" id="background_color"
                                           value="{{ old('background_color', $project->background_color ?? '#f9fafb') }}"
                                           class="w-12 h-12 border-2 border-gray-200 rounded-lg cursor-pointer">
                                    <input type="text" id="background_color_text"
                                           value="{{ old('background_color', $project->background_color ?? '#f9fafb') }}"
                                           class="w-28 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 font-mono text-sm">
                                    <div class="flex gap-1.5">
                                        @foreach(['#f9fafb' => 'Gray', '#fef3c7' => 'Amber', '#dbeafe' => 'Blue', '#dcfce7' => 'Green', '#fce7f3' => 'Pink', '#f3e8ff' => 'Purple'] as $color => $name)
                                            <button type="button" onclick="setColor('{{ $color }}')"
                                                    class="w-8 h-8 rounded-lg border-2 border-gray-200 hover:border-blue-500 hover:scale-110 transition"
                                                    style="background-color: {{ $color }}" title="{{ $name }}"></button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="border-gray-200">

                        {{-- Display Settings --}}
                        <div class="space-y-4">
                            <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider">Display Settings</h3>

                            <div class="flex items-center gap-6">
                                <div>
                                    <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Display Order</label>
                                    <input type="number" name="order" id="order" value="{{ old('order', $project->order ?? 0) }}" min="0"
                                        class="w-24 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <label class="flex items-center gap-3 cursor-pointer mt-5">
                                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}
                                        class="w-5 h-5 rounded border-gray-300 text-blue-500 focus:ring-blue-500">
                                    <span class="text-sm font-medium text-gray-700">Featured Project</span>
                                </label>
                            </div>
                        </div>

                        <hr class="border-gray-200">

                        {{-- Access Control --}}
                        <div class="space-y-4">
                            <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                Client Access
                            </h3>

                            @if($clientPasswords->count() > 0)
                                <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 space-y-3">
                                    @foreach($clientPasswords as $clientPassword)
                                        <label class="flex items-center gap-3 cursor-pointer">
                                            <input type="checkbox" name="client_passwords[]" value="{{ $clientPassword->id }}"
                                                {{ in_array($clientPassword->id, old('client_passwords', $assignedClientIds)) ? 'checked' : '' }}
                                                class="w-5 h-5 rounded border-gray-300 text-blue-500 focus:ring-blue-500">
                                            <span class="text-sm text-gray-700">{{ $clientPassword->name }}</span>
                                            @if(!$clientPassword->is_active)
                                                <span class="text-xs text-red-500 bg-red-50 px-2 py-0.5 rounded-full">Inactive</span>
                                            @endif
                                        </label>
                                    @endforeach
                                </div>
                                <p class="text-xs text-gray-500">Select clients who can access this case study. Leave unchecked for public access.</p>
                            @else
                                <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 text-center">
                                    <p class="text-sm text-gray-500">No client passwords created yet.</p>
                                    <a href="{{ route('admin.client-passwords.create') }}" class="text-sm text-blue-500 hover:underline">Create one</a>
                                </div>
                            @endif
                        </div>

                        {{-- Legacy Content --}}
                        <div x-data="{ showLegacy: false }">
                            <button type="button" @click="showLegacy = !showLegacy"
                                class="flex items-center gap-2 text-sm text-gray-500 hover:text-gray-700">
                                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-90': showLegacy }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                Legacy HTML Content
                            </button>
                            <div x-show="showLegacy" x-collapse class="mt-4">
                                <textarea name="content_legacy" id="content_legacy" rows="8"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 font-mono text-sm">{{ old('content_legacy', $project->content_legacy) }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Legacy HTML content shown when no blocks are added.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Preview Sidebar (Normal Mode) --}}
            <div x-show="!focusMode" class="hidden xl:block">
                <div class="sticky top-24">
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                        <div class="px-4 py-3 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white flex items-center justify-between">
                            <div>
                                <h3 class="font-semibold text-gray-900">Live Preview</h3>
                                <p class="text-xs text-gray-500">Click blocks to select</p>
                            </div>
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700"
                                  x-text="blocks.length + ' block' + (blocks.length !== 1 ? 's' : '')"></span>
                        </div>

                        <div class="preview-container max-h-[70vh] overflow-y-auto bg-gray-50">
                            <template x-if="blocks.length === 0">
                                <div class="flex items-center justify-center h-48 text-gray-400">
                                    <div class="text-center">
                                        <svg class="w-10 h-10 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <p class="text-sm">Preview appears here</p>
                                    </div>
                                </div>
                            </template>

                            <template x-for="(block, index) in blocks" :key="block.id + '-preview'">
                                <div class="preview-block border-b border-gray-200 last:border-b-0 cursor-pointer transition-all"
                                     :class="{ 'ring-2 ring-blue-400 ring-inset bg-blue-50/30': selectedBlockIndex === index }"
                                     @click="selectBlock(index)">
                                    @include('admin.projects.partials.block-previews')
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Live Preview (Focus Mode - Right Column) --}}
            <div x-show="focusMode" x-cloak class="hidden lg:block">
                <div class="sticky top-24">
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                        <div class="px-4 py-3 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-white flex items-center justify-between">
                            <div>
                                <h3 class="font-semibold text-gray-900">Live Preview</h3>
                                <p class="text-xs text-gray-500">Click blocks to select & edit</p>
                            </div>
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700"
                                  x-text="blocks.length + ' block' + (blocks.length !== 1 ? 's' : '')"></span>
                        </div>

                        <div class="preview-container max-h-[calc(100vh-10rem)] overflow-y-auto bg-gray-50">
                            <template x-if="blocks.length === 0">
                                <div class="flex items-center justify-center h-64 text-gray-400">
                                    <div class="text-center">
                                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <p class="font-medium">No blocks yet</p>
                                        <p class="text-sm">Add content blocks to see preview</p>
                                    </div>
                                </div>
                            </template>

                            <template x-for="(block, index) in blocks" :key="block.id + '-focus-preview'">
                                <div class="preview-block border-b border-gray-200 last:border-b-0 cursor-pointer transition-all"
                                     :class="{ 'ring-2 ring-blue-400 ring-inset bg-blue-50/30': selectedBlockIndex === index }"
                                     @click="selectBlock(index)">
                                    @include('admin.projects.partials.block-previews')
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
    .focus-mode {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 50;
        background: #f3f4f6;
        overflow-y: auto;
        padding: 0 1.5rem;
    }

    .focus-mode > .sticky:first-child {
        position: sticky;
        top: 0;
        margin-left: -1.5rem;
        margin-right: -1.5rem;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }

    .focus-mode .preview-container + .sticky,
    .focus-mode form .sticky {
        top: 5rem;
    }
</style>

<script>
    const colorPicker = document.getElementById('background_color');
    const colorText = document.getElementById('background_color_text');

    colorPicker?.addEventListener('input', function() {
        colorText.value = this.value;
    });

    colorText?.addEventListener('input', function() {
        if (/^#[0-9A-Fa-f]{6}$/.test(this.value)) {
            colorPicker.value = this.value;
        }
    });

    function setColor(color) {
        if (colorPicker && colorText) {
            colorPicker.value = color;
            colorText.value = color;
        }
    }
</script>
@endsection
