@extends('layouts.frontend')

@section('title', $project->title . ' - ' . $settings['site_title'])

@section('content')
<article>
    <!-- Title & Overview Section -->
    <div class="max-w-6xl mx-auto px-4 md:px-6 py-16 md:py-24">
        <!-- Back Link -->
        <a href="{{ route('home') }}#case-studies" class="inline-flex items-center text-[#00959f] hover:underline mb-8 transition">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to case studies
        </a>

        <!-- Title -->
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-semibold text-gray-900 mb-8 leading-tight">
            {{ $project->title }}
        </h1>

        <!-- Banner Image -->
        @php
            $bannerImage = $project->use_cover_as_banner ? $project->image : $project->banner_image;
        @endphp
        @if($bannerImage)
            <div class="mb-12 rounded-2xl overflow-hidden">
                <img src="{{ asset('storage/' . $bannerImage) }}"
                     alt="{{ $project->title }}"
                     class="w-full h-auto object-cover">
            </div>
        @endif

        <!-- Description -->
        @if($project->description)
            <p class="text-xl md:text-2xl text-gray-600 leading-relaxed mb-12">
                {{ $project->description }}
            </p>
        @endif

        <!-- Metadata Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 py-8 border-t border-b border-gray-200">
            @if($project->client_name)
                <div>
                    <p class="text-sm text-gray-400 uppercase tracking-wider mb-2">Client</p>
                    <p class="text-gray-900 font-medium">{{ $project->client_name }}</p>
                </div>
            @endif

            @if($project->category)
                <div>
                    <p class="text-sm text-gray-400 uppercase tracking-wider mb-2">Category</p>
                    <p class="text-gray-900 font-medium">{{ $project->category->name }}</p>
                </div>
            @endif

            @if($project->tags && count($project->tags) > 0)
                <div class="col-span-2">
                    <p class="text-sm text-gray-400 uppercase tracking-wider mb-2">Skills</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($project->tags as $tag)
                            <span class="text-gray-900 font-medium">{{ $tag }}@if(!$loop->last), @endif</span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Content Section -->
    @if($project->hasContentBlocks())
        {{-- Render Content Blocks --}}
        <div class="content-blocks space-y-12 md:space-y-16 pb-16">
            @foreach($project->getBlocks() as $block)
                @php
                    $blockType = $block['type'] ?? 'text';
                    $blockData = $block['data'] ?? [];
                @endphp

                @includeIf('components.blocks.' . str_replace('_', '-', $blockType), ['data' => $blockData])
            @endforeach
        </div>
    @elseif($project->content_legacy)
        {{-- Legacy HTML Content --}}
        <div class="max-w-6xl mx-auto px-4 md:px-6 pb-20">
            <div class="prose prose-lg md:prose-xl prose-gray max-w-none
                        prose-headings:font-semibold prose-headings:text-gray-900
                        prose-h2:text-3xl prose-h2:mt-16 prose-h2:mb-6
                        prose-h3:text-2xl prose-h3:mt-12 prose-h3:mb-4
                        prose-p:text-gray-600 prose-p:leading-relaxed
                        prose-img:rounded-2xl prose-img:shadow-lg prose-img:my-12
                        prose-a:text-[#00959f] prose-a:no-underline hover:prose-a:underline
                        prose-strong:text-gray-900
                        prose-ul:text-gray-600 prose-ol:text-gray-600">
                {!! $project->content_legacy !!}
            </div>
        </div>
    @endif
</article>

<!-- Next Case Study -->
@if($nextProject)
    <section class="border-t border-gray-200">
        <a href="{{ route('project.show', $nextProject->slug) }}" class="block group">
            <div class="max-w-6xl mx-auto px-4 md:px-6 py-16 md:py-24">
                <p class="text-sm text-gray-400 uppercase tracking-wider mb-4">Next Case Study</p>
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-8">
                    <div>
                        <h2 class="text-3xl md:text-4xl font-semibold text-gray-900 group-hover:text-[#00959f] transition mb-4">
                            {{ $nextProject->title }}
                        </h2>
                        @if($nextProject->description)
                            <p class="text-gray-600 text-lg max-w-xl">{{ Str::limit($nextProject->description, 120) }}</p>
                        @endif
                    </div>
                    <div class="flex-shrink-0">
                        <span class="inline-flex items-center text-[#00959f] font-medium group-hover:underline">
                            View case study
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
            @if($nextProject->image)
                <div class="w-full h-64 md:h-80 overflow-hidden">
                    <img src="{{ asset('storage/' . $nextProject->image) }}" alt="{{ $nextProject->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                </div>
            @endif
        </a>
    </section>
@endif
@endsection
