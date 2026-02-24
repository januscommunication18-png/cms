import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Block Builder Component for Content Blocks
window.blockBuilder = function(initialData, blockTypes) {
    return {
        blocks: initialData?.blocks || [],
        blockTypes: blockTypes || {},
        selectedBlockIndex: null,
        draggedIndex: null,
        uploadProgress: {},

        init() {
            // Ensure each block has a unique ID and collapse by default
            this.blocks = this.blocks.map((block, index) => ({
                ...block,
                id: block.id || this.generateId(),
                collapsed: true
            }));
        },

        generateId() {
            return 'block_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
        },

        addBlock(type) {
            const blockType = this.blockTypes[type];
            if (!blockType) return;

            const newBlock = {
                id: this.generateId(),
                type: type,
                order: this.blocks.length,
                data: JSON.parse(JSON.stringify(blockType.default_data || {})),
                collapsed: false
            };

            this.blocks.push(newBlock);
            this.selectedBlockIndex = this.blocks.length - 1;
            this.updateHiddenInput();
        },

        removeBlock(index) {
            if (confirm('Are you sure you want to remove this block?')) {
                this.blocks.splice(index, 1);
                this.reorderBlocks();
                this.selectedBlockIndex = null;
                this.updateHiddenInput();
            }
        },

        duplicateBlock(index) {
            const original = this.blocks[index];
            const duplicate = {
                ...JSON.parse(JSON.stringify(original)),
                id: this.generateId(),
                order: index + 1
            };
            this.blocks.splice(index + 1, 0, duplicate);
            this.reorderBlocks();
            this.updateHiddenInput();
        },

        moveBlockUp(index) {
            if (index > 0) {
                const block = this.blocks.splice(index, 1)[0];
                this.blocks.splice(index - 1, 0, block);
                this.reorderBlocks();
                this.updateHiddenInput();
            }
        },

        moveBlockDown(index) {
            if (index < this.blocks.length - 1) {
                const block = this.blocks.splice(index, 1)[0];
                this.blocks.splice(index + 1, 0, block);
                this.reorderBlocks();
                this.updateHiddenInput();
            }
        },

        toggleBlock(index) {
            this.blocks[index].collapsed = !this.blocks[index].collapsed;
        },

        selectBlock(index) {
            this.selectedBlockIndex = index;
        },

        reorderBlocks() {
            this.blocks.forEach((block, index) => {
                block.order = index;
            });
        },

        // Drag and Drop
        dragStart(event, index) {
            this.draggedIndex = index;
            event.dataTransfer.effectAllowed = 'move';
            event.dataTransfer.setData('text/plain', index);
            event.target.classList.add('opacity-50');
        },

        dragEnd(event) {
            event.target.classList.remove('opacity-50');
            this.draggedIndex = null;
        },

        dragOver(event) {
            event.preventDefault();
            event.dataTransfer.dropEffect = 'move';
        },

        dragEnter(event, index) {
            if (this.draggedIndex !== null && this.draggedIndex !== index) {
                event.target.closest('.block-item')?.classList.add('border-purple-500', 'border-2');
            }
        },

        dragLeave(event) {
            event.target.closest('.block-item')?.classList.remove('border-purple-500', 'border-2');
        },

        drop(event, dropIndex) {
            event.preventDefault();
            event.target.closest('.block-item')?.classList.remove('border-purple-500', 'border-2');

            if (this.draggedIndex !== null && this.draggedIndex !== dropIndex) {
                const draggedBlock = this.blocks.splice(this.draggedIndex, 1)[0];
                this.blocks.splice(dropIndex, 0, draggedBlock);
                this.reorderBlocks();
                this.updateHiddenInput();
            }
            this.draggedIndex = null;
        },

        // Image Upload
        async uploadImage(event, blockIndex, field) {
            const file = event.target.files[0];
            if (!file) return;

            const formData = new FormData();
            formData.append('image', file);
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

            const uploadKey = `${blockIndex}_${field}`;
            this.uploadProgress[uploadKey] = 0;

            try {
                const response = await fetch('/admin/blocks/upload', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const result = await response.json();

                if (result.success) {
                    this.blocks[blockIndex].data[field] = result.path;
                    this.updateHiddenInput();
                } else {
                    alert('Upload failed: ' + (result.message || 'Unknown error'));
                }
            } catch (error) {
                console.error('Upload error:', error);
                alert('Upload failed. Please try again.');
            } finally {
                delete this.uploadProgress[uploadKey];
            }
        },

        // Gallery/Multiple Images Upload
        async uploadGalleryImage(event, blockIndex) {
            const files = event.target.files;
            if (!files.length) return;

            for (const file of files) {
                const formData = new FormData();
                formData.append('image', file);

                try {
                    const response = await fetch('/admin/blocks/upload', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });

                    const result = await response.json();

                    if (result.success) {
                        if (!this.blocks[blockIndex].data.images) {
                            this.blocks[blockIndex].data.images = [];
                        }
                        this.blocks[blockIndex].data.images.push({
                            path: result.path,
                            caption: ''
                        });
                        this.updateHiddenInput();
                    }
                } catch (error) {
                    console.error('Upload error:', error);
                }
            }
        },

        removeGalleryImage(blockIndex, imageIndex) {
            this.blocks[blockIndex].data.images.splice(imageIndex, 1);
            this.updateHiddenInput();
        },

        // Stats block helpers
        addStat(blockIndex) {
            if (!this.blocks[blockIndex].data.stats) {
                this.blocks[blockIndex].data.stats = [];
            }
            this.blocks[blockIndex].data.stats.push({ value: '', label: '' });
            this.updateHiddenInput();
        },

        removeStat(blockIndex, statIndex) {
            this.blocks[blockIndex].data.stats.splice(statIndex, 1);
            this.updateHiddenInput();
        },

        // Timeline block helpers
        addTimelineItem(blockIndex) {
            if (!this.blocks[blockIndex].data.items) {
                this.blocks[blockIndex].data.items = [];
            }
            this.blocks[blockIndex].data.items.push({ date: '', title: '', description: '' });
            this.updateHiddenInput();
        },

        removeTimelineItem(blockIndex, itemIndex) {
            this.blocks[blockIndex].data.items.splice(itemIndex, 1);
            this.updateHiddenInput();
        },

        // Icon Grid helpers
        addGridItem(blockIndex) {
            if (!this.blocks[blockIndex].data.items) {
                this.blocks[blockIndex].data.items = [];
            }
            this.blocks[blockIndex].data.items.push({ icon: '', title: '', description: '' });
            this.updateHiddenInput();
        },

        removeGridItem(blockIndex, itemIndex) {
            this.blocks[blockIndex].data.items.splice(itemIndex, 1);
            this.updateHiddenInput();
        },

        // Accordion helpers
        addAccordionItem(blockIndex) {
            if (!this.blocks[blockIndex].data.items) {
                this.blocks[blockIndex].data.items = [];
            }
            this.blocks[blockIndex].data.items.push({ title: '', content: '' });
            this.updateHiddenInput();
        },

        removeAccordionItem(blockIndex, itemIndex) {
            this.blocks[blockIndex].data.items.splice(itemIndex, 1);
            this.updateHiddenInput();
        },

        // Get image URL for preview
        getImageUrl(path) {
            if (!path) return '';
            if (path.startsWith('http')) return path;
            return '/storage/' + path;
        },

        // Get block type info
        getBlockTypeInfo(type) {
            return this.blockTypes[type] || { name: type, icon: '📦' };
        },

        // Get preview title for collapsed blocks
        getBlockPreview(block) {
            if (!block || !block.data) return '';

            const data = block.data;
            let preview = '';

            switch (block.type) {
                case 'text':
                    preview = data.heading || this.stripHtml(data.content);
                    break;
                case 'two-column':
                    preview = data.left_title || data.right_title || this.stripHtml(data.left_content) || this.stripHtml(data.right_content);
                    break;
                case 'hero':
                    preview = data.title || data.subtitle;
                    break;
                case 'image':
                    preview = data.caption || data.alt || 'Image';
                    break;
                case 'gallery':
                    preview = data.images ? `${data.images.length} image${data.images.length !== 1 ? 's' : ''}` : '';
                    break;
                case 'quote':
                    preview = this.stripHtml(data.quote) || data.author;
                    break;
                case 'stats':
                    preview = data.stats ? `${data.stats.length} stat${data.stats.length !== 1 ? 's' : ''}` : '';
                    break;
                case 'timeline':
                    preview = data.items ? `${data.items.length} item${data.items.length !== 1 ? 's' : ''}` : '';
                    break;
                case 'icon-grid':
                    preview = data.items ? `${data.items.length} item${data.items.length !== 1 ? 's' : ''}` : '';
                    break;
                case 'accordion':
                    preview = data.items ? `${data.items.length} item${data.items.length !== 1 ? 's' : ''}` : '';
                    break;
                case 'cta':
                    preview = data.title || data.button_text;
                    break;
                case 'video':
                    preview = data.title || 'Video embed';
                    break;
                case 'code':
                    preview = data.language || 'Code block';
                    break;
                case 'divider':
                    preview = data.style || 'Divider';
                    break;
                default:
                    // Try common field names
                    preview = data.title || data.heading || data.name || '';
            }

            // Truncate to reasonable length
            if (preview && preview.length > 50) {
                preview = preview.substring(0, 50) + '...';
            }

            return preview;
        },

        // Strip HTML tags from content
        stripHtml(html) {
            if (!html) return '';
            const tmp = document.createElement('div');
            tmp.innerHTML = html;
            return tmp.textContent || tmp.innerText || '';
        },

        // Update hidden input for form submission
        updateHiddenInput() {
            const input = document.getElementById('content_blocks_input');
            if (input) {
                input.value = JSON.stringify({
                    blocks: this.blocks.map(({ collapsed, ...block }) => block),
                    version: 1
                });
            }
        },

        // Get JSON for form submission
        getBlocksJson() {
            return JSON.stringify({
                blocks: this.blocks.map(({ collapsed, ...block }) => block),
                version: 1
            });
        }
    };
};

Alpine.start();
