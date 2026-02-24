<?php

namespace App\Services;

use Illuminate\Support\Str;

class ContentBlockService
{
    /**
     * Get all available block types with metadata
     */
    public static function getBlockTypes(): array
    {
        return [
            'hero' => [
                'name' => 'Hero',
                'icon' => 'photograph',
                'description' => 'Full-width image with overlay text',
                'category' => 'Layout',
                'default_data' => [
                    'image' => '',
                    'title' => '',
                    'subtitle' => '',
                    'overlay_opacity' => 40,
                ],
            ],
            'text' => [
                'name' => 'Text',
                'icon' => 'document-text',
                'description' => 'Rich text paragraph',
                'category' => 'Content',
                'default_data' => [
                    'heading' => '',
                    'content' => '',
                ],
            ],
            'image' => [
                'name' => 'Image',
                'icon' => 'photograph',
                'description' => 'Single image with caption',
                'category' => 'Media',
                'default_data' => [
                    'image' => '',
                    'caption' => '',
                    'alt' => '',
                    'size' => 'full',
                ],
            ],
            'two_column' => [
                'name' => 'Two Column',
                'icon' => 'view-boards',
                'description' => 'Text + image or text + text',
                'category' => 'Layout',
                'default_data' => [
                    'left_content' => '',
                    'right_content' => '',
                    'right_image' => '',
                ],
            ],
            'stats' => [
                'name' => 'Stats',
                'icon' => 'chart-bar',
                'description' => 'Number stats with labels',
                'category' => 'Content',
                'default_data' => [
                    'heading' => '',
                    'stats' => [],
                ],
            ],
            'quote' => [
                'name' => 'Quote',
                'icon' => 'chat-alt',
                'description' => 'Testimonial with attribution',
                'category' => 'Content',
                'default_data' => [
                    'text' => '',
                    'author' => '',
                    'role' => '',
                ],
            ],
            'gallery' => [
                'name' => 'Gallery',
                'icon' => 'view-grid',
                'description' => 'Image grid',
                'category' => 'Media',
                'default_data' => [
                    'images' => [],
                    'columns' => 3,
                ],
            ],
            'video' => [
                'name' => 'Video',
                'icon' => 'play',
                'description' => 'YouTube/Vimeo embed',
                'category' => 'Media',
                'default_data' => [
                    'url' => '',
                    'caption' => '',
                ],
            ],
            'callout' => [
                'name' => 'Callout',
                'icon' => 'exclamation-circle',
                'description' => 'Highlighted box with icon',
                'category' => 'Content',
                'default_data' => [
                    'type' => 'info',
                    'title' => '',
                    'content' => '',
                ],
            ],
            'icon_grid' => [
                'name' => 'Icon Grid',
                'icon' => 'view-grid-add',
                'description' => 'Features with icons',
                'category' => 'Content',
                'default_data' => [
                    'heading' => '',
                    'items' => [],
                ],
            ],
            'timeline' => [
                'name' => 'Timeline',
                'icon' => 'clock',
                'description' => 'Process steps',
                'category' => 'Content',
                'default_data' => [
                    'heading' => '',
                    'items' => [],
                ],
            ],
            'comparison' => [
                'name' => 'Comparison',
                'icon' => 'switch-horizontal',
                'description' => 'Before/after or side-by-side',
                'category' => 'Media',
                'default_data' => [
                    'heading' => '',
                    'before_image' => '',
                    'after_image' => '',
                    'caption' => '',
                ],
            ],
            'carousel' => [
                'name' => 'Carousel',
                'icon' => 'collection',
                'description' => 'Image slider',
                'category' => 'Media',
                'default_data' => [
                    'images' => [],
                ],
            ],
            'code' => [
                'name' => 'Code',
                'icon' => 'code',
                'description' => 'Syntax highlighted code block',
                'category' => 'Content',
                'default_data' => [
                    'code' => '',
                    'language' => 'javascript',
                    'filename' => '',
                ],
            ],
            'accordion' => [
                'name' => 'Accordion',
                'icon' => 'menu-alt-2',
                'description' => 'Expandable sections',
                'category' => 'Content',
                'default_data' => [
                    'heading' => '',
                    'items' => [],
                ],
            ],
            'cta' => [
                'name' => 'CTA',
                'icon' => 'cursor-click',
                'description' => 'Call-to-action button section',
                'category' => 'Content',
                'default_data' => [
                    'heading' => '',
                    'description' => '',
                    'button_text' => '',
                    'button_url' => '',
                    'background_color' => '#00959f',
                ],
            ],
        ];
    }

    /**
     * Process blocks array and ensure proper structure
     */
    public function processBlocks(array $blocks): array
    {
        $processedBlocks = [];

        foreach ($blocks as $index => $block) {
            $block['order'] = $index;
            $block['id'] = $block['id'] ?? Str::uuid()->toString();
            $processedBlocks[] = $block;
        }

        return [
            'blocks' => $processedBlocks,
            'version' => 1,
        ];
    }

    /**
     * Get default data for a block type
     */
    public function getDefaultData(string $type): array
    {
        $defaults = [
            'hero' => [
                'image' => '',
                'title' => '',
                'subtitle' => '',
                'overlay_color' => '#000000',
                'overlay_opacity' => 40,
                'text_alignment' => 'center',
            ],
            'text' => [
                'content' => '',
            ],
            'image' => [
                'image' => '',
                'caption' => '',
                'alt_text' => '',
                'size' => 'full',
            ],
            'two_column' => [
                'layout' => 'text-image',
                'left_content' => '',
                'right_content' => '',
                'right_image' => '',
            ],
            'stats' => [
                'items' => [
                    ['value' => '', 'label' => ''],
                ],
            ],
            'quote' => [
                'quote' => '',
                'author' => '',
                'role' => '',
                'image' => '',
            ],
            'gallery' => [
                'images' => [],
                'columns' => 3,
                'gap' => 'medium',
            ],
            'video' => [
                'url' => '',
                'caption' => '',
                'autoplay' => false,
            ],
            'callout' => [
                'icon' => 'info',
                'title' => '',
                'content' => '',
                'style' => 'info',
            ],
            'icon_grid' => [
                'items' => [
                    ['icon' => '', 'title' => '', 'description' => ''],
                ],
                'columns' => 3,
            ],
            'timeline' => [
                'items' => [
                    ['title' => '', 'description' => '', 'date' => ''],
                ],
            ],
            'comparison' => [
                'type' => 'before-after',
                'before_image' => '',
                'after_image' => '',
                'before_label' => 'Before',
                'after_label' => 'After',
            ],
            'carousel' => [
                'images' => [],
                'autoplay' => false,
                'show_arrows' => true,
                'show_dots' => true,
            ],
            'code' => [
                'code' => '',
                'language' => 'javascript',
                'filename' => '',
                'show_line_numbers' => true,
            ],
            'accordion' => [
                'items' => [
                    ['title' => '', 'content' => ''],
                ],
                'allow_multiple' => false,
            ],
            'cta' => [
                'title' => '',
                'description' => '',
                'button_text' => '',
                'button_url' => '',
                'style' => 'primary',
                'background' => 'dark',
            ],
        ];

        return $defaults[$type] ?? [];
    }

    /**
     * Get block types grouped by category
     */
    public static function getBlockTypesByCategory(): array
    {
        $types = self::getBlockTypes();
        $grouped = [];

        foreach ($types as $key => $type) {
            $category = $type['category'] ?? 'Other';
            if (!isset($grouped[$category])) {
                $grouped[$category] = [];
            }
            $grouped[$category][$key] = $type;
        }

        return $grouped;
    }
}
