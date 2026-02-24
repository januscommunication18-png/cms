@extends('layouts.frontend')

@section('title', 'Client Login - ' . $settings['site_title'])

@section('content')
<section class="py-20 px-4 md:px-6 min-h-[60vh] flex items-center">
    <div class="max-w-md mx-auto w-full">
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-semibold text-gray-900 mb-4">Client Access</h1>
            <p class="text-gray-600">Enter your password to view your assigned case studies.</p>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('client.login.submit') }}" method="POST" class="bg-white rounded-2xl shadow-lg p-8">
            @csrf

            <div class="mb-6">
                <label for="client_name" class="block text-sm font-medium text-gray-700 mb-2">Client Name</label>
                <input type="text" name="client_name" id="client_name" required value="{{ old('client_name') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00959f] focus:border-transparent"
                    placeholder="Enter your client name">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00959f] focus:border-transparent"
                    placeholder="Enter your client password">
            </div>

            <button type="submit" class="w-full bg-[#00959f] text-white py-3 px-6 rounded-lg font-medium hover:bg-[#007a82] transition">
                Access Case Studies
            </button>
        </form>

        <p class="text-center mt-6 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="text-[#00959f] hover:underline">&larr; Back to Home</a>
        </p>
    </div>
</section>
@endsection
