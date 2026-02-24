<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'content_legacy', 'content_blocks',
        'image', 'banner_image', 'use_cover_as_banner', 'background_color',
        'category_id', 'tags', 'client_name', 'is_featured', 'is_protected',
        'password', 'order'
    ];

    protected $casts = [
        'tags' => 'array',
        'content_blocks' => 'array',
        'is_featured' => 'boolean',
        'is_protected' => 'boolean',
        'use_cover_as_banner' => 'boolean',
    ];

    protected $hidden = ['password'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function clientPasswords()
    {
        return $this->belongsToMany(ClientPassword::class);
    }

    public function visits()
    {
        return $this->hasMany(ProjectVisit::class);
    }

    /**
     * Check if project is protected (has client passwords assigned)
     */
    public function isProtected()
    {
        return $this->clientPasswords()->exists();
    }

    /**
     * Get plain text title (strips HTML tags)
     */
    public function getPlainTitle(): string
    {
        return strip_tags($this->title ?? '');
    }

    /**
     * Get plain text description (strips HTML tags)
     */
    public function getPlainDescription(): string
    {
        return strip_tags($this->description ?? '');
    }

    /**
     * Get blocks sorted by order
     */
    public function getBlocks(): array
    {
        $data = $this->content_blocks ?? ['blocks' => [], 'version' => 1];
        $blocks = $data['blocks'] ?? [];

        usort($blocks, fn($a, $b) => ($a['order'] ?? 0) <=> ($b['order'] ?? 0));

        return $blocks;
    }

    /**
     * Set blocks with proper ordering
     */
    public function setBlocks(array $blocks): void
    {
        $orderedBlocks = array_values(array_map(function ($block, $index) {
            $block['order'] = $index;
            if (empty($block['id'])) {
                $block['id'] = Str::uuid()->toString();
            }
            return $block;
        }, $blocks, array_keys($blocks)));

        $this->content_blocks = [
            'blocks' => $orderedBlocks,
            'version' => 1,
        ];
    }

    /**
     * Check if project has content blocks (vs legacy content)
     */
    public function hasContentBlocks(): bool
    {
        return !empty($this->content_blocks['blocks']);
    }

    /**
     * Get all images used in content blocks (for cleanup)
     */
    public function getBlockImages(): array
    {
        $images = [];
        foreach ($this->getBlocks() as $block) {
            $this->extractImagesFromData($block['data'] ?? [], $images);
        }
        return $images;
    }

    /**
     * Extract images recursively from block data
     */
    private function extractImagesFromData(array $data, array &$images): void
    {
        foreach ($data as $key => $value) {
            if (is_string($value) && Str::startsWith($value, 'projects/')) {
                $images[] = $value;
            } elseif (is_array($value)) {
                $this->extractImagesFromData($value, $images);
            }
        }
    }
}
