@extends('layouts.frontend')

@section('title', 'Case Studies - ' . $settings['site_title'])

@section('content')
<!-- Hero Section -->
<section class="py-20 px-4 md:px-6">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-semibold text-gray-900 mb-6 leading-tight">
            Case Studies
        </h1>
        <p class="text-xl md:text-2xl text-gray-600 max-w-2xl">
            Selected projects showcasing end-to-end product design work across various industries.
        </p>
    </div>
</section>

<!-- Case Studies Section -->
<section class="pb-20 px-4 md:px-6" x-data="{ activeCategory: 'all' }">
    <div class="max-w-6xl mx-auto">

        <!-- Category Filter -->
        @if($categories->count() > 0)
        <div class="flex flex-wrap gap-3 mb-16">
            <button
                @click="activeCategory = 'all'"
                :class="activeCategory === 'all' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                class="px-5 py-2 rounded-full text-sm font-medium transition">
                All
            </button>
            @foreach($categories as $category)
                <button
                    @click="activeCategory = '{{ $category->slug }}'"
                    :class="activeCategory === '{{ $category->slug }}' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-5 py-2 rounded-full text-sm font-medium transition">
                    {{ $category->name }}
                </button>
            @endforeach
        </div>
        @endif

        <!-- Case Studies List -->
        <div class="space-y-16">
            @foreach($projects as $index => $project)
                <article
                    x-show="activeCategory === 'all' || activeCategory === '{{ $project->category?->slug }}'"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    class="group">

                    <div class="rounded-[32px] md:rounded-[40px] overflow-hidden" style="background-color: {{ $project->background_color ?? '#f9fafb' }}">
                        @if($project->client_passwords_count > 0 && !session()->has('project_access_' . $project->id) && !session()->has('client_password_id'))
                            {{-- Password Protected Card - Show Name & Password Form --}}
                            <div class="p-8 md:p-12 lg:p-16 min-h-[400px] flex flex-col justify-center items-center text-center">
                                <div class="w-16 h-16 bg-white/50 rounded-full flex items-center justify-center mb-6">
                                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 mb-3">{{ $project->title }}</h2>
                                <p class="text-gray-500 mb-8 max-w-md">This case study is password protected. Enter your details to view.</p>

                                <form action="{{ route('project.verify-password', $project->slug) }}" method="POST" class="w-full max-w-sm space-y-4">
                                    @csrf
                                    <div>
                                        <input type="text" name="visitor_name" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00959f] focus:border-transparent text-center"
                                            placeholder="Your Name">
                                    </div>
                                    <div>
                                        <input type="password" name="password" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00959f] focus:border-transparent text-center"
                                            placeholder="Password">
                                    </div>
                                    @if($errors->any() && old('_token') && request()->route('slug') == $project->slug)
                                        <p class="text-red-500 text-sm">{{ $errors->first() }}</p>
                                    @endif
                                    <button type="submit" class="w-full bg-[#00959f] text-white py-3 px-6 rounded-lg font-medium hover:bg-[#007a82] transition">
                                        View Case Study
                                    </button>
                                </form>
                            </div>
                        @else
                            {{-- Normal Card - Show Full Content --}}
                            <div class="flex flex-col {{ $index % 2 == 0 ? 'md:flex-row' : 'md:flex-row-reverse' }}">

                                <!-- Image Section -->
                                <div class="md:w-1/2 relative">
                                    <a href="{{ route('project.show', $project->slug) }}" class="block aspect-[4/3] md:aspect-auto md:h-full">
                                        @if($project->image)
                                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                        @else
                                            <div class="w-full h-full min-h-[300px] bg-gray-200 flex items-center justify-center text-gray-400">
                                                <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </a>
                                </div>

                                <!-- Content Section -->
                                <div class="md:w-1/2 p-8 md:p-12 lg:p-16 flex flex-col justify-center">
                                    <!-- Client Name -->
                                    @if($project->client_name)
                                        <p class="text-sm font-medium text-gray-400 uppercase tracking-wider mb-3">
                                            {{ $project->client_name }}
                                        </p>
                                    @endif

                                    <!-- Project Title -->
                                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-semibold text-gray-900 mb-4 leading-tight">
                                        {{ $project->title }}
                                    </h2>

                                    <!-- Description -->
                                    @if($project->description)
                                        <p class="text-gray-600 text-base md:text-lg mb-6 leading-relaxed">
                                            {{ $project->description }}
                                        </p>
                                    @endif

                                    <!-- Tags -->
                                    @if($project->tags && count($project->tags) > 0)
                                        <div class="flex flex-wrap gap-2 mb-8">
                                            @foreach($project->tags as $tag)
                                                <span class="text-sm text-gray-600 bg-white px-4 py-1.5 rounded-full border border-gray-200">
                                                    {{ $tag }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif

                                    <!-- CTA Link -->
                                    <div class="mt-auto">
                                        <a href="{{ route('project.show', $project->slug) }}"
                                           class="inline-flex items-center text-[#00959f] font-medium hover:underline group/link">
                                            <span>View case study</span>
                                            <svg class="w-4 h-4 ml-2 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>

        @if($projects->count() === 0)
            <div class="text-center py-20 text-gray-500">
                <p>No case studies to display yet.</p>
            </div>
        @endif
    </div>
</section>
@endsection
