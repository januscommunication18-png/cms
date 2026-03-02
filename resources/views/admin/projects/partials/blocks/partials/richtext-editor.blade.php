{{--
    Rich Text Editor Partial using Quill with Google Fonts
    Usage: @include('admin.projects.partials.blocks.partials.richtext-editor', [
        'field' => 'content',      // The field name in block.data
        'label' => 'Content',      // Label text
        'placeholder' => 'Enter content...'  // Optional placeholder
    ])
--}}
@php
    $field = $field ?? 'content';
    $label = $label ?? 'Content';
    $placeholder = $placeholder ?? 'Enter content...';
@endphp

<div x-data="{
    quillInstance: null,
    initQuill() {
        const container = this.$refs.quillContainer;
        if (!container || this.quillInstance) return;

        // Wait for global font registration
        if (typeof Quill === 'undefined' || !window.quillFontsRegistered) {
            setTimeout(() => this.initQuill(), 50);
            return;
        }

        const Font = Quill.import('formats/font');
        const Size = Quill.import('attributors/style/size');

        // Get default font from site settings
        const defaultFont = window.getQuillDefaultFont ? window.getQuillDefaultFont() : 'inter';

        this.quillInstance = new Quill(container, {
            theme: 'snow',
            placeholder: '{{ $placeholder }}',
            modules: {
                toolbar: [
                    [{ 'font': Font.whitelist }],
                    [{ 'size': Size.whitelist }],
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],
                    [{ 'align': [] }],
                    ['link'],
                    ['clean']
                ]
            }
        });

        // Set initial content
        const initialContent = block.data.{{ $field }} || '';
        if (initialContent) {
            this.quillInstance.root.innerHTML = initialContent;
        }

        // Always set and show default font
        this.$nextTick(() => {
            // Apply default font format
            if (!initialContent) {
                this.quillInstance.format('font', defaultFont);
            }

            // Update the font picker dropdown to show default font
            const toolbar = this.quillInstance.getModule('toolbar');
            if (toolbar && toolbar.container) {
                const fontPicker = toolbar.container.querySelector('.ql-font');
                if (fontPicker) {
                    const pickerLabel = fontPicker.querySelector('.ql-picker-label');
                    if (pickerLabel) {
                        pickerLabel.setAttribute('data-value', defaultFont);
                    }
                    // Also select the item in dropdown
                    const pickerItems = fontPicker.querySelectorAll('.ql-picker-item');
                    pickerItems.forEach(item => {
                        if (item.getAttribute('data-value') === defaultFont) {
                            item.classList.add('ql-selected');
                        } else {
                            item.classList.remove('ql-selected');
                        }
                    });
                }
            }
        });

        // Listen for changes
        this.quillInstance.on('text-change', () => {
            block.data.{{ $field }} = this.quillInstance.root.innerHTML;
            updateHiddenInput();
        });
    }
}"
x-init="$nextTick(() => { setTimeout(() => initQuill(), 150) })">
    <label class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    <div x-ref="quillContainer" class="bg-white"></div>
</div>
