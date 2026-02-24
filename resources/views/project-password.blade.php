@extends('layouts.frontend')

@section('title', $project->title . ' - Password Protected')

@section('content')
<div class="min-h-[60vh] flex items-center justify-center px-6">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-6">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $project->title }}</h1>
            <p class="text-gray-500">This case study is password protected. Please enter your details to view.</p>
        </div>

        <form action="{{ route('project.verify-password', $project->slug) }}" method="POST" class="space-y-6">
            @csrf

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <div>
                <label for="visitor_name" class="block text-sm font-medium text-gray-700 mb-1">Your Name *</label>
                <input type="text" name="visitor_name" id="visitor_name" required autofocus
                    value="{{ old('visitor_name') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00959f] focus:border-[#00959f]"
                    placeholder="Enter your name">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password *</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00959f] focus:border-[#00959f]"
                    placeholder="Enter password">
            </div>

            <button type="submit" class="w-full bg-[#00959f] text-white py-3 rounded-lg font-medium hover:bg-[#007a82] transition">
                View Case Study
            </button>
        </form>

        <p class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-900 transition">
                &larr; Back to case studies
            </a>
        </p>
    </div>
</div>
@endsection
