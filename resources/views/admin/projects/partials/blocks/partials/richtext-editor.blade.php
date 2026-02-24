{{--
    Rich Text Editor Partial
    Usage: @include('admin.projects.partials.blocks.partials.richtext-editor', [
        'field' => 'content',      // The field name in block.data
        'label' => 'Content',      // Label text
        'placeholder' => 'Enter content...'  // Optional placeholder
    ])
--}}
@php
    $field = $field ?? 'content';
    $label = $label ?? 'Content';
    $editorId = 'richtext_' . $field . '_';
@endphp

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>

    {{-- Toolbar --}}
    <div class="flex flex-wrap items-center gap-1 p-2 bg-gray-50 border border-b-0 border-gray-300 rounded-t-md">
        {{-- Font Size --}}
        <div class="flex items-center gap-0.5 pr-2 border-r border-gray-300">
            <select
                @change="
                    const editor = document.getElementById('{{ $editorId }}' + block.id);
                    editor.focus();
                    document.execCommand('fontSize', false, $event.target.value);
                    block.data.{{ $field }} = editor.innerHTML;
                    updateHiddenInput();
                    $event.target.value = '';
                "
                class="text-xs border-gray-300 rounded py-1 px-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Size</option>
                <option value="1">Small</option>
                <option value="3">Normal</option>
                <option value="5">Large</option>
                <option value="7">XL</option>
            </select>
        </div>

        {{-- Text Style --}}
        <div class="flex items-center gap-0.5 pr-2 border-r border-gray-300">
            <button type="button"
                @mousedown.prevent="
                    const editor = document.getElementById('{{ $editorId }}' + block.id);
                    editor.focus();
                    document.execCommand('bold');
                    block.data.{{ $field }} = editor.innerHTML;
                    updateHiddenInput();
                "
                class="p-1.5 rounded hover:bg-gray-200 text-gray-700" title="Bold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z"/><path d="M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z"/>
                </svg>
            </button>
            <button type="button"
                @mousedown.prevent="
                    const editor = document.getElementById('{{ $editorId }}' + block.id);
                    editor.focus();
                    document.execCommand('italic');
                    block.data.{{ $field }} = editor.innerHTML;
                    updateHiddenInput();
                "
                class="p-1.5 rounded hover:bg-gray-200 text-gray-700" title="Italic">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <line x1="19" y1="4" x2="10" y2="4"/><line x1="14" y1="20" x2="5" y2="20"/><line x1="15" y1="4" x2="9" y2="20"/>
                </svg>
            </button>
            <button type="button"
                @mousedown.prevent="
                    const editor = document.getElementById('{{ $editorId }}' + block.id);
                    editor.focus();
                    document.execCommand('underline');
                    block.data.{{ $field }} = editor.innerHTML;
                    updateHiddenInput();
                "
                class="p-1.5 rounded hover:bg-gray-200 text-gray-700" title="Underline">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M6 3v7a6 6 0 006 6 6 6 0 006-6V3"/><line x1="4" y1="21" x2="20" y2="21"/>
                </svg>
            </button>
        </div>

        {{-- Lists --}}
        <div class="flex items-center gap-0.5 px-2 border-r border-gray-300">
            <button type="button"
                @mousedown.prevent="
                    const editor = document.getElementById('{{ $editorId }}' + block.id);
                    editor.focus();
                    document.execCommand('insertUnorderedList', false, null);
                    block.data.{{ $field }} = editor.innerHTML;
                    updateHiddenInput();
                "
                class="p-1.5 rounded hover:bg-gray-200 text-gray-700" title="Bullet List">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                    <circle cx="4" cy="6" r="2"/><circle cx="4" cy="12" r="2"/><circle cx="4" cy="18" r="2"/>
                    <rect x="9" y="5" width="12" height="2" rx="1"/>
                    <rect x="9" y="11" width="12" height="2" rx="1"/>
                    <rect x="9" y="17" width="12" height="2" rx="1"/>
                </svg>
            </button>
            <button type="button"
                @mousedown.prevent="
                    const editor = document.getElementById('{{ $editorId }}' + block.id);
                    editor.focus();
                    document.execCommand('insertOrderedList', false, null);
                    block.data.{{ $field }} = editor.innerHTML;
                    updateHiddenInput();
                "
                class="p-1.5 rounded hover:bg-gray-200 text-gray-700" title="Numbered List">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                    <text x="1" y="8" font-size="7" font-family="Arial" stroke="none">1</text>
                    <text x="1" y="14" font-size="7" font-family="Arial" stroke="none">2</text>
                    <text x="1" y="20" font-size="7" font-family="Arial" stroke="none">3</text>
                    <rect x="9" y="5" width="12" height="2" rx="1"/>
                    <rect x="9" y="11" width="12" height="2" rx="1"/>
                    <rect x="9" y="17" width="12" height="2" rx="1"/>
                </svg>
            </button>
        </div>

        {{-- Text Color --}}
        <div class="flex items-center gap-0.5 px-2 border-r border-gray-300">
            <label class="p-1.5 rounded hover:bg-gray-200 text-gray-700 cursor-pointer" title="Text Color">
                <input type="color" class="absolute opacity-0 w-0 h-0"
                    @input="
                        const editor = document.getElementById('{{ $editorId }}' + block.id);
                        editor.focus();
                        document.execCommand('foreColor', false, $event.target.value);
                        block.data.{{ $field }} = editor.innerHTML;
                        updateHiddenInput();
                    ">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                    <text x="4" y="16" font-size="14" font-family="Arial" font-weight="bold">A</text>
                    <rect x="2" y="20" width="20" height="3" rx="1"/>
                </svg>
            </label>
        </div>

        {{-- Link --}}
        <div class="flex items-center gap-0.5 px-2 border-r border-gray-300">
            <button type="button"
                @mousedown.prevent="
                    const url = prompt('Enter URL:');
                    if (url) {
                        const editor = document.getElementById('{{ $editorId }}' + block.id);
                        editor.focus();
                        document.execCommand('createLink', false, url);
                        block.data.{{ $field }} = editor.innerHTML;
                        updateHiddenInput();
                    }
                "
                class="p-1.5 rounded hover:bg-gray-200 text-gray-700" title="Insert Link">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/>
                    <path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/>
                </svg>
            </button>
        </div>

        {{-- Clear Formatting --}}
        <div class="flex items-center gap-0.5 pl-2">
            <button type="button"
                @mousedown.prevent="
                    const editor = document.getElementById('{{ $editorId }}' + block.id);
                    editor.focus();
                    document.execCommand('removeFormat');
                    block.data.{{ $field }} = editor.innerHTML;
                    updateHiddenInput();
                "
                class="p-1.5 rounded hover:bg-gray-200 text-gray-700" title="Clear Formatting">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M4 7V4h16v3"/><path d="M9 20h6"/><path d="M12 4v16"/>
                    <line x1="4" y1="20" x2="20" y2="4"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Editor Area --}}
    <div :id="'{{ $editorId }}' + block.id"
        x-init="$el.innerHTML = block.data.{{ $field }} || '<p><br></p>'"
        contenteditable="true"
        @input="block.data.{{ $field }} = $el.innerHTML; updateHiddenInput()"
        @focus="if (!$el.innerHTML || $el.innerHTML.trim() === '' || $el.innerHTML === '<br>') { $el.innerHTML = '<p><br></p>'; }"
        class="w-full min-h-[100px] p-3 border border-gray-300 rounded-b-md bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500
               [&_ul]:list-disc [&_ul]:ml-5 [&_ol]:list-decimal [&_ol]:ml-5 [&_li]:my-1
               [&_h2]:text-xl [&_h2]:font-bold [&_h2]:my-2 [&_h3]:text-lg [&_h3]:font-semibold [&_h3]:my-2
               [&_a]:text-blue-600 [&_a]:underline"
        style="outline: none;">
    </div>
</div>
