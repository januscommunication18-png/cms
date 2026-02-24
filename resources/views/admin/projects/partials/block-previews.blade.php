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

{{-- Two Column Preview --}}
<template x-if="block.type === 'two_column'">
    @include('admin.projects.partials.blocks.two-column-preview')
</template>

{{-- Stats Preview --}}
<template x-if="block.type === 'stats'">
    @include('admin.projects.partials.blocks.stats-preview')
</template>

{{-- Quote Preview --}}
<template x-if="block.type === 'quote'">
    @include('admin.projects.partials.blocks.quote-preview')
</template>

{{-- Gallery Preview --}}
<template x-if="block.type === 'gallery'">
    @include('admin.projects.partials.blocks.gallery-preview')
</template>

{{-- Video Preview --}}
<template x-if="block.type === 'video'">
    @include('admin.projects.partials.blocks.video-preview')
</template>

{{-- Callout Preview --}}
<template x-if="block.type === 'callout'">
    @include('admin.projects.partials.blocks.callout-preview')
</template>

{{-- CTA Preview --}}
<template x-if="block.type === 'cta'">
    @include('admin.projects.partials.blocks.cta-preview')
</template>

{{-- Icon Grid Preview --}}
<template x-if="block.type === 'icon_grid'">
    @include('admin.projects.partials.blocks.icon-grid-preview')
</template>

{{-- Timeline Preview --}}
<template x-if="block.type === 'timeline'">
    @include('admin.projects.partials.blocks.timeline-preview')
</template>

{{-- Comparison Preview --}}
<template x-if="block.type === 'comparison'">
    @include('admin.projects.partials.blocks.comparison-preview')
</template>

{{-- Carousel Preview --}}
<template x-if="block.type === 'carousel'">
    @include('admin.projects.partials.blocks.carousel-preview')
</template>

{{-- Code Preview --}}
<template x-if="block.type === 'code'">
    @include('admin.projects.partials.blocks.code-preview')
</template>

{{-- Accordion Preview --}}
<template x-if="block.type === 'accordion'">
    @include('admin.projects.partials.blocks.accordion-preview')
</template>
