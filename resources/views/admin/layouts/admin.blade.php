<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&family=Roboto:wght@400;500;700&family=Open+Sans:wght@400;500;600;700&family=Lato:wght@400;700&family=Montserrat:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&family=Merriweather:wght@400;700&family=Source+Sans+3:wght@400;600;700&family=Raleway:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700&family=Outfit:wght@400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&family=Sora:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Quill Editor --}}
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Quill Editor Custom Styles */
        .ql-editor {
            min-height: 120px;
            font-size: 14px;
        }
        .ql-container {
            font-family: inherit;
        }
        .ql-toolbar.ql-snow {
            border-top-left-radius: 0.375rem;
            border-top-right-radius: 0.375rem;
            background: #f9fafb;
        }
        .ql-container.ql-snow {
            border-bottom-left-radius: 0.375rem;
            border-bottom-right-radius: 0.375rem;
        }
        /* Font picker styles */
        .ql-snow .ql-picker.ql-font {
            width: 130px;
        }
        .ql-snow .ql-picker.ql-font .ql-picker-label::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item::before {
            content: 'Sans Serif';
        }
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="inter"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="inter"]::before {
            content: 'Inter';
            font-family: 'Inter', sans-serif;
        }
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="playfair"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="playfair"]::before {
            content: 'Playfair Display';
            font-family: 'Playfair Display', serif;
        }
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="roboto"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="roboto"]::before {
            content: 'Roboto';
            font-family: 'Roboto', sans-serif;
        }
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="opensans"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="opensans"]::before {
            content: 'Open Sans';
            font-family: 'Open Sans', sans-serif;
        }
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="lato"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="lato"]::before {
            content: 'Lato';
            font-family: 'Lato', sans-serif;
        }
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="montserrat"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="montserrat"]::before {
            content: 'Montserrat';
            font-family: 'Montserrat', sans-serif;
        }
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="poppins"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="poppins"]::before {
            content: 'Poppins';
            font-family: 'Poppins', sans-serif;
        }
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="merriweather"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="merriweather"]::before {
            content: 'Merriweather';
            font-family: 'Merriweather', serif;
        }
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="sourcesans"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="sourcesans"]::before {
            content: 'Source Sans';
            font-family: 'Source Sans 3', sans-serif;
        }
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="raleway"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="raleway"]::before {
            content: 'Raleway';
            font-family: 'Raleway', sans-serif;
        }
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="plusjakarta"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="plusjakarta"]::before {
            content: 'Plus Jakarta Sans';
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="dmsans"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="dmsans"]::before {
            content: 'DM Sans';
            font-family: 'DM Sans', sans-serif;
        }
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="manrope"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="manrope"]::before {
            content: 'Manrope';
            font-family: 'Manrope', sans-serif;
        }
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="outfit"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="outfit"]::before {
            content: 'Outfit';
            font-family: 'Outfit', sans-serif;
        }
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="spacegrotesk"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="spacegrotesk"]::before {
            content: 'Space Grotesk';
            font-family: 'Space Grotesk', sans-serif;
        }
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="sora"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="sora"]::before {
            content: 'Sora';
            font-family: 'Sora', sans-serif;
        }
        /* Apply fonts in editor and output */
        .ql-font-inter, .ql-editor .ql-font-inter { font-family: 'Inter', sans-serif !important; }
        .ql-font-playfair, .ql-editor .ql-font-playfair { font-family: 'Playfair Display', serif !important; }
        .ql-font-roboto, .ql-editor .ql-font-roboto { font-family: 'Roboto', sans-serif !important; }
        .ql-font-opensans, .ql-editor .ql-font-opensans { font-family: 'Open Sans', sans-serif !important; }
        .ql-font-lato, .ql-editor .ql-font-lato { font-family: 'Lato', sans-serif !important; }
        .ql-font-montserrat, .ql-editor .ql-font-montserrat { font-family: 'Montserrat', sans-serif !important; }
        .ql-font-poppins, .ql-editor .ql-font-poppins { font-family: 'Poppins', sans-serif !important; }
        .ql-font-merriweather, .ql-editor .ql-font-merriweather { font-family: 'Merriweather', serif !important; }
        .ql-font-sourcesans, .ql-editor .ql-font-sourcesans { font-family: 'Source Sans 3', sans-serif !important; }
        .ql-font-raleway, .ql-editor .ql-font-raleway { font-family: 'Raleway', sans-serif !important; }
        .ql-font-plusjakarta, .ql-editor .ql-font-plusjakarta { font-family: 'Plus Jakarta Sans', sans-serif !important; }
        .ql-font-dmsans, .ql-editor .ql-font-dmsans { font-family: 'DM Sans', sans-serif !important; }
        .ql-font-manrope, .ql-editor .ql-font-manrope { font-family: 'Manrope', sans-serif !important; }
        .ql-font-outfit, .ql-editor .ql-font-outfit { font-family: 'Outfit', sans-serif !important; }
        .ql-font-spacegrotesk, .ql-editor .ql-font-spacegrotesk { font-family: 'Space Grotesk', sans-serif !important; }
        .ql-font-sora, .ql-editor .ql-font-sora { font-family: 'Sora', sans-serif !important; }
        /* Size picker styles */
        .ql-snow .ql-picker.ql-size .ql-picker-label::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item::before {
            content: 'Size';
        }
        .ql-snow .ql-picker.ql-size .ql-picker-label[data-value="12px"]::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="12px"]::before { content: '12px'; }
        .ql-snow .ql-picker.ql-size .ql-picker-label[data-value="14px"]::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="14px"]::before { content: '14px'; }
        .ql-snow .ql-picker.ql-size .ql-picker-label[data-value="16px"]::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="16px"]::before { content: '16px'; }
        .ql-snow .ql-picker.ql-size .ql-picker-label[data-value="18px"]::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="18px"]::before { content: '18px'; }
        .ql-snow .ql-picker.ql-size .ql-picker-label[data-value="20px"]::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="20px"]::before { content: '20px'; }
        .ql-snow .ql-picker.ql-size .ql-picker-label[data-value="24px"]::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="24px"]::before { content: '24px'; }
        .ql-snow .ql-picker.ql-size .ql-picker-label[data-value="28px"]::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="28px"]::before { content: '28px'; }
        .ql-snow .ql-picker.ql-size .ql-picker-label[data-value="32px"]::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="32px"]::before { content: '32px'; }
        .ql-snow .ql-picker.ql-size .ql-picker-label[data-value="36px"]::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="36px"]::before { content: '36px'; }
        .ql-snow .ql-picker.ql-size .ql-picker-label[data-value="48px"]::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="48px"]::before { content: '48px'; }
    </style>

    <script>
        // Site font from settings
        window.siteDefaultFont = '{{ $siteFont ?? "Inter" }}';

        // Map site font names to Quill font class names
        window.fontNameToQuill = {
            'Messina Sans': 'inter', // fallback to Inter
            'Inter': 'inter',
            'Plus Jakarta Sans': 'plusjakarta',
            'Poppins': 'poppins',
            'DM Sans': 'dmsans',
            'Manrope': 'manrope',
            'Outfit': 'outfit',
            'Space Grotesk': 'spacegrotesk',
            'Sora': 'sora',
            'Playfair Display': 'playfair',
            'Roboto': 'roboto',
            'Open Sans': 'opensans',
            'Lato': 'lato',
            'Montserrat': 'montserrat',
            'Merriweather': 'merriweather',
            'Source Sans 3': 'sourcesans',
            'Raleway': 'raleway'
        };

        window.getQuillDefaultFont = function() {
            return window.fontNameToQuill[window.siteDefaultFont] || 'inter';
        };

        // Register Quill fonts and sizes globally (once)
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof Quill !== 'undefined' && !window.quillFontsRegistered) {
                const Font = Quill.import('formats/font');
                Font.whitelist = ['inter', 'playfair', 'roboto', 'opensans', 'lato', 'montserrat', 'poppins', 'merriweather', 'sourcesans', 'raleway', 'plusjakarta', 'dmsans', 'manrope', 'outfit', 'spacegrotesk', 'sora'];
                Quill.register(Font, true);

                const Size = Quill.import('attributors/style/size');
                Size.whitelist = ['12px', '14px', '16px', '18px', '20px', '24px', '28px', '32px', '36px', '48px'];
                Quill.register(Size, true);

                window.quillFontsRegistered = true;
            }
        });
    </script>
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 w-64 bg-gray-900 text-white">
            <div class="p-6">
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold">Portfolio Admin</a>
            </div>
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.projects.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.projects.*') ? 'bg-gray-800' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Projects
                </a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.categories.*') ? 'bg-gray-800' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    Categories
                </a>
                <a href="{{ route('admin.clients.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.clients.*') ? 'bg-gray-800' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    Clients
                </a>
                <a href="{{ route('admin.client-passwords.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.client-passwords.*') ? 'bg-gray-800' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                    Client Passwords
                </a>
                <a href="{{ route('admin.project-visits.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.project-visits.*') ? 'bg-gray-800' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    Case Study Visits
                </a>
                <a href="{{ route('admin.settings.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.settings.*') ? 'bg-gray-800' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Settings
                </a>
                <div class="border-t border-gray-800 mt-6 pt-6">
                    <a href="{{ route('home') }}" class="flex items-center px-6 py-3 hover:bg-gray-800" target="_blank">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        View Site
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-6 py-3 hover:bg-gray-800 text-left">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Logout
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="ml-64 p-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
