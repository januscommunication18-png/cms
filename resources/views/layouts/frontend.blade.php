<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $settings['site_title'] ?? 'Portfolio')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @php
        $fontName = $settings['font_name'] ?? 'Messina Sans';
        $googleFonts = [
            'Inter' => 'Inter:wght@400;500;600;700',
            'Plus Jakarta Sans' => 'Plus+Jakarta+Sans:wght@400;500;600;700',
            'Poppins' => 'Poppins:wght@400;500;600;700',
            'DM Sans' => 'DM+Sans:wght@400;500;600;700',
            'Manrope' => 'Manrope:wght@400;500;600;700',
            'Outfit' => 'Outfit:wght@400;500;600;700',
            'Space Grotesk' => 'Space+Grotesk:wght@400;500;600;700',
            'Sora' => 'Sora:wght@400;500;600;700',
        ];
    @endphp
    @if(isset($googleFonts[$fontName]))
        <link href="https://fonts.googleapis.com/css2?family={{ $googleFonts[$fontName] }}&display=swap" rel="stylesheet">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: '{{ $fontName }}', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-white text-gray-900">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 bg-white/95 backdrop-blur-sm z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold text-gray-900">
                    {{ $settings['site_title'] ?? 'Portfolio' }}
                </a>
                <nav class="flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="transition font-medium {{ request()->routeIs('home') ? 'text-[#00959f]' : 'text-gray-600 hover:text-gray-900' }}">
                        Home
                    </a>
                    <a href="{{ route('case-studies') }}" class="transition font-medium {{ request()->routeIs('case-studies') || request()->routeIs('project.show') ? 'text-[#00959f]' : 'text-gray-600 hover:text-gray-900' }}">
                        Case Study
                    </a>
                    <a href="{{ route('contact') }}" class="transition font-medium {{ request()->routeIs('contact') ? 'text-[#00959f]' : 'text-gray-600 hover:text-gray-900' }}">
                        Contact us
                    </a>
                    @if(isset($settings['linkedin_url']) && $settings['linkedin_url'])
                        <a href="{{ $settings['linkedin_url'] }}" target="_blank" class="text-gray-600 hover:text-gray-900 transition font-medium">
                            LinkedIn
                        </a>
                    @endif

                    @if(session()->has('client_password_id'))
                        <div class="flex items-center space-x-4 border-l border-gray-200 pl-6">
                            <span class="text-sm text-gray-500">Hi, {{ session('client_name') }}</span>
                            <a href="{{ route('client.logout') }}" class="text-sm text-red-600 hover:text-red-800 font-medium">
                                Logout
                            </a>
                        </div>
                    @endif
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-50 border-t border-gray-100 py-12 mt-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-500 text-sm">
                    &copy; {{ date('Y') }} Designed by {{ $settings['site_title'] ?? 'Portfolio' }}
                </p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    @if(isset($settings['linkedin_url']) && $settings['linkedin_url'])
                        <a href="{{ $settings['linkedin_url'] }}" target="_blank" class="text-gray-500 hover:text-gray-900 transition">LinkedIn</a>
                    @endif
                    <a href="{{ route('contact') }}" class="text-gray-500 hover:text-gray-900 transition">Contact</a>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
