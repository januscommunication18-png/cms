@extends('layouts.frontend')

@section('title', 'Contact - ' . $settings['site_title'])

@section('content')
<div class="py-20 px-6">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Get in touch</h1>
        <p class="text-xl text-gray-600 mb-12">
            Have a project in mind? Let's chat about how we can work together.
        </p>

        @if(session('success'))
            <div class="mb-8 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00959f] focus:border-[#00959f] @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00959f] focus:border-[#00959f] @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message *</label>
                <textarea name="message" id="message" rows="6" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00959f] focus:border-[#00959f] @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                @error('message')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Human Verification -->
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <label for="captcha" class="block text-sm font-medium text-gray-700 mb-2">
                    Are you human? *
                </label>
                <div class="flex items-center gap-4">
                    <span class="text-lg font-medium text-gray-900 bg-white px-4 py-2 rounded border border-gray-300">
                        {{ $captcha['num1'] }} + {{ $captcha['num2'] }} = ?
                    </span>
                    <input type="number" name="captcha" id="captcha" required
                        class="w-24 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00959f] focus:border-[#00959f] @error('captcha') border-red-500 @enderror"
                        placeholder="?">
                    <input type="hidden" name="captcha_answer" value="{{ $captcha['answer'] }}">
                </div>
                @error('captcha')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-gray-900 text-white py-3 rounded-lg font-medium hover:bg-gray-800 transition">
                Send Message
            </button>
        </form>

        @if(isset($settings['email']) && $settings['email'])
            <div class="mt-12 pt-12 border-t border-gray-200">
                <p class="text-gray-600 mb-2">Or reach out directly:</p>
                <a href="mailto:{{ $settings['email'] }}" class="text-[#00959f] font-medium hover:text-[#007a82]">
                    {{ $settings['email'] }}
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
