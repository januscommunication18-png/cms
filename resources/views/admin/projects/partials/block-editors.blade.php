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

{{-- Icon Grid Block --}}
<template x-if="block.type === 'icon_grid'">
    @include('admin.projects.partials.blocks.icon-grid-editor')
</template>

{{-- Timeline Block --}}
<template x-if="block.type === 'timeline'">
    @include('admin.projects.partials.blocks.timeline-editor')
</template>

{{-- Comparison Block --}}
<template x-if="block.type === 'comparison'">
    @include('admin.projects.partials.blocks.comparison-editor')
</template>

{{-- Carousel Block --}}
<template x-if="block.type === 'carousel'">
    @include('admin.projects.partials.blocks.carousel-editor')
</template>

{{-- Code Block --}}
<template x-if="block.type === 'code'">
    @include('admin.projects.partials.blocks.code-editor')
</template>

{{-- Accordion Block --}}
<template x-if="block.type === 'accordion'">
    @include('admin.projects.partials.blocks.accordion-editor')
</template>
