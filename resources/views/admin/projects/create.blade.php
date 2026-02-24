@extends('admin.layouts.admin')

@section('content')
<div x-data="{
        focusMode: false,
        activeTab: 'content',
        ...blockBuilder({{ json_encode(['blocks' => [], 'version' => 1]) }}, {{ json_encode($blockTypes) }})
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
                    <h1 class="text-xl font-bold text-gray-900">Create Project</h1>
                    <p class="text-sm text-gray-500">New case study</p>
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

                {{-- Save Button --}}
                <button type="submit" form="project-form"
                        class="flex items-center gap-2 px-4 py-2 text-sm bg-blue-500 text-white hover:bg-blue-600 rounded-lg transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Create Project
                </button>
            </div>
        </div>
    </div>

    <form id="project-form" action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
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
                                                <svg class="w-4 h-4 text-gray-400" viewBox="0 0 24 24" fill="currentColor">
                                                    <circle cx="9" cy="5" r="1.5"/>
                                                    <circle cx="15" cy="5" r="1.5"/>
                                                    <circle cx="9" cy="10" r="1.5"/>
                                                    <circle cx="15" cy="10" r="1.5"/>
                                                    <circle cx="9" cy="15" r="1.5"/>
                                                    <circle cx="15" cy="15" r="1.5"/>
                                                    <circle cx="9" cy="20" r="1.5"/>
                                                    <circle cx="15" cy="20" r="1.5"/>
                                                </svg>
                                            </div>
                                            <span class="font-medium text-gray-700" x-text="blockTypes[block.type]?.name || block.type"></span>
                                            <span class="text-xs text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full" x-text="'#' + (index + 1)"></span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            {{-- Collapse indicator --}}
                                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200"
                                                 :class="{ 'rotate-180': !block.collapsed }"
                                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                            </svg>
                                            <button type="button" @click.stop="duplicateBlock(index)"
                                                class="p-1.5 text-gray-400 hover:text-green-500 rounded-lg hover:bg-green-50 transition" title="Duplicate">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                </svg>
                                            </button>
                                            <button type="button" @click.stop="removeBlock(index)"
                                                class="p-1.5 text-gray-400 hover:text-red-500 rounded-lg hover:bg-red-50 transition" title="Delete">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    {{-- Block Editor (Collapsible) --}}
                                    <div x-show="!block.collapsed" x-collapse class="p-4 space-y-4">
                                        @include('admin.projects.partials.block-editors')
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- Settings Tab --}}
                    <div x-show="activeTab === 'settings'" class="p-6 space-y-6">
                        {{-- Basic Information --}}
                        <div class="space-y-4">
                            <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider">Basic Information</h3>

                            {{-- Project Title --}}
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Project Title *</label>
                                <input type="text" name="title" id="title" required
                                    value="{{ old('title') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            {{-- Short Description --}}
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Short Description</label>
                                <textarea name="description" id="description" rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                    <select name="category_id" id="category_id"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">No Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="client_name" class="block text-sm font-medium text-gray-700 mb-1">Client Name</label>
                                    <input type="text" name="client_name" id="client_name" value="{{ old('client_name') }}"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>

                            <div>
                                <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Tags (comma-separated)</label>
                                <input type="text" name="tags" id="tags" value="{{ old('tags') }}" placeholder="Mobile App, B2C, Healthcare"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        {{-- Appearance --}}
                        <div class="space-y-4 pt-6 border-t">
                            <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider">Appearance</h3>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Card Background Color</label>
                                <div class="flex items-center gap-4">
                                    <input type="color" name="background_color" id="background_color" value="{{ old('background_color', '#f9fafb') }}"
                                        class="w-12 h-10 border-gray-300 rounded cursor-pointer">
                                    <input type="text" id="background_color_text" value="{{ old('background_color', '#f9fafb') }}"
                                        class="w-28 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 font-mono text-sm"
                                        placeholder="#f9fafb">
                                    <div class="flex gap-1">
                                        <button type="button" onclick="setColor('#f9fafb')" class="w-7 h-7 rounded border-2 border-gray-300 bg-gray-50 hover:border-blue-500" title="Light Gray"></button>
                                        <button type="button" onclick="setColor('#fef3c7')" class="w-7 h-7 rounded border-2 border-gray-300 bg-amber-100 hover:border-blue-500" title="Amber"></button>
                                        <button type="button" onclick="setColor('#dbeafe')" class="w-7 h-7 rounded border-2 border-gray-300 bg-blue-100 hover:border-blue-500" title="Blue"></button>
                                        <button type="button" onclick="setColor('#dcfce7')" class="w-7 h-7 rounded border-2 border-gray-300 bg-green-100 hover:border-blue-500" title="Green"></button>
                                        <button type="button" onclick="setColor('#fce7f3')" class="w-7 h-7 rounded border-2 border-gray-300 bg-pink-100 hover:border-blue-500" title="Pink"></button>
                                        <button type="button" onclick="setColor('#f3e8ff')" class="w-7 h-7 rounded border-2 border-gray-300 bg-purple-100 hover:border-blue-500" title="Purple"></button>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Cover Image</label>
                                <input type="file" name="image" id="image" accept="image/*"
                                    class="w-full border border-gray-300 rounded-md shadow-sm text-sm file:mr-4 file:py-2 file:px-4 file:border-0 file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                            </div>

                            <div>
                                <label for="banner_image" class="block text-sm font-medium text-gray-700 mb-1">Banner Image</label>
                                <input type="file" name="banner_image" id="banner_image" accept="image/*"
                                    class="w-full border border-gray-300 rounded-md shadow-sm text-sm file:mr-4 file:py-2 file:px-4 file:border-0 file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                                <p class="text-xs text-gray-500 mt-1">This image will be displayed after the project title on the detail page.</p>
                            </div>

                            <div>
                                <label class="flex items-center">
                                    <input type="checkbox" name="use_cover_as_banner" value="1" {{ old('use_cover_as_banner') ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-blue-500 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Use cover image as banner</span>
                                </label>
                            </div>
                        </div>

                        {{-- Display Settings --}}
                        <div class="space-y-4 pt-6 border-t">
                            <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider">Display Settings</h3>

                            <div>
                                <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Display Order</label>
                                <input type="number" name="order" id="order" value="{{ old('order', 0) }}" min="0"
                                    class="w-24 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <p class="text-xs text-gray-500 mt-1">Lower numbers appear first</p>
                            </div>

                            <div>
                                <label class="flex items-center">
                                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-blue-500 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Featured Project</span>
                                </label>
                            </div>
                        </div>

                        {{-- Access Control --}}
                        <div class="space-y-4 pt-6 border-t">
                            <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                Access Control
                            </h3>

                            @if($clientPasswords->count() > 0)
                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 space-y-2">
                                    @foreach($clientPasswords as $clientPassword)
                                        <label class="flex items-center">
                                            <input type="checkbox" name="client_passwords[]" value="{{ $clientPassword->id }}"
                                                {{ in_array($clientPassword->id, old('client_passwords', [])) ? 'checked' : '' }}
                                                class="rounded border-gray-300 text-blue-500 focus:ring-blue-500">
                                            <span class="ml-2 text-sm text-gray-700">{{ $clientPassword->name }}</span>
                                            @if(!$clientPassword->is_active)
                                                <span class="ml-2 text-xs text-red-500">(Inactive)</span>
                                            @endif
                                        </label>
                                    @endforeach
                                </div>
                                <p class="text-xs text-gray-500">Select clients who can access this case study. If none selected, project will be public.</p>
                            @else
                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                    <p class="text-sm text-gray-500">No client passwords created yet. <a href="{{ route('admin.client-passwords.create') }}" class="text-blue-500 hover:underline">Create one</a></p>
                                </div>
                            @endif
                        </div>

                        {{-- Legacy Content --}}
                        <div x-data="{ showLegacy: false }" class="pt-6 border-t">
                            <button type="button" @click="showLegacy = !showLegacy"
                                class="flex items-center gap-2 text-sm text-gray-500 hover:text-gray-700">
                                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-90': showLegacy }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                Legacy HTML Content (Optional)
                            </button>
                            <div x-show="showLegacy" x-collapse class="mt-4">
                                <textarea name="content_legacy" id="content_legacy" rows="10"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 font-mono text-sm">{{ old('content_legacy') }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Use this only if you need to paste raw HTML.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Live Preview Panel --}}
            <div :class="focusMode ? '' : 'xl:col-span-1'">
                <div class="sticky top-20">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-4 py-3 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="font-semibold text-gray-900">Live Preview</h3>
                                    <p class="text-xs text-gray-500">Content blocks preview</p>
                                </div>
                                <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded-full" x-text="blocks.length + ' block' + (blocks.length !== 1 ? 's' : '')"></span>
                            </div>
                        </div>

                        <div class="preview-container overflow-y-auto bg-gray-50" style="max-height: calc(100vh - 200px);">
                            <template x-if="blocks.length === 0">
                                <div class="flex items-center justify-center h-64 text-gray-400">
                                    <div class="text-center">
                                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <p class="font-medium">Preview will appear here</p>
                                        <p class="text-sm mt-1">Add content blocks to see preview</p>
                                    </div>
                                </div>
                            </template>

                            <div class="bg-white">
                                <template x-for="(block, index) in blocks" :key="block.id + '-preview'">
                                    <div class="preview-block cursor-pointer transition-all duration-200"
                                         :class="{ 'ring-2 ring-blue-400 ring-inset': selectedBlockIndex === index }"
                                         @click="selectBlock(index); if(block.collapsed) toggleBlock(index);">
                                        @include('admin.projects.partials.block-previews')
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Color picker sync
    const colorPicker = document.getElementById('background_color');
    const colorText = document.getElementById('background_color_text');

    colorPicker.addEventListener('input', function() {
        colorText.value = this.value;
    });

    colorText.addEventListener('input', function() {
        if (/^#[0-9A-Fa-f]{6}$/.test(this.value)) {
            colorPicker.value = this.value;
        }
    });

    function setColor(color) {
        colorPicker.value = color;
        colorText.value = color;
    }
</script>
@endsection
