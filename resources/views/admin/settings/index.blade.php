@extends('admin.layouts.admin')

@section('content')
<h1 class="text-3xl font-bold mb-8">Site Settings</h1>

<form action="{{ route('admin.settings.update') }}" method="POST" class="max-w-2xl">
    @csrf

    <div class="bg-white rounded-lg shadow p-6 space-y-6">
        <div>
            <label for="site_title" class="block text-sm font-medium text-gray-700 mb-1">Site Title *</label>
            <input type="text" name="site_title" id="site_title" value="{{ old('site_title', $settings['site_title']) }}" required
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="site_tagline" class="block text-sm font-medium text-gray-700 mb-1">Tagline</label>
            <input type="text" name="site_tagline" id="site_tagline" value="{{ old('site_tagline', $settings['site_tagline']) }}"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="font_name" class="block text-sm font-medium text-gray-700 mb-1">Font</label>
            <select name="font_name" id="font_name"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @php
                    $fonts = [
                        'Messina Sans' => 'Messina Sans (Default)',
                        'Inter' => 'Inter',
                        'Plus Jakarta Sans' => 'Plus Jakarta Sans',
                        'Poppins' => 'Poppins',
                        'DM Sans' => 'DM Sans',
                        'Manrope' => 'Manrope',
                        'Outfit' => 'Outfit',
                        'Space Grotesk' => 'Space Grotesk',
                        'Sora' => 'Sora',
                    ];
                    $currentFont = old('font_name', $settings['font_name'] ?? 'Messina Sans');
                @endphp
                @foreach($fonts as $value => $label)
                    <option value="{{ $value }}" {{ $currentFont === $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            <p class="text-xs text-gray-500 mt-1">Select the font for your website</p>
        </div>

        <div>
            <label for="about_text" class="block text-sm font-medium text-gray-700 mb-1">About Text</label>
            <textarea name="about_text" id="about_text" rows="5"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('about_text', $settings['about_text']) }}</textarea>
        </div>

        <div>
            <label for="linkedin_url" class="block text-sm font-medium text-gray-700 mb-1">LinkedIn URL</label>
            <input type="url" name="linkedin_url" id="linkedin_url" value="{{ old('linkedin_url', $settings['linkedin_url']) }}" placeholder="https://linkedin.com/in/yourprofile"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Contact Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $settings['email']) }}" placeholder="hello@example.com"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Security Settings -->
        <div class="border-t pt-6 mt-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Security Settings</h3>

            <div class="flex items-center justify-between">
                <div>
                    <label for="security_code_enabled" class="text-sm font-medium text-gray-700">Security Code Protection</label>
                    <p class="text-xs text-gray-500 mt-1">Require a 4-digit code to access the site (Valid codes: 1000, 2000, 3000, 4000)</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="security_code_enabled" id="security_code_enabled" value="1"
                        {{ old('security_code_enabled', $settings['security_code_enabled']) == '1' ? 'checked' : '' }}
                        class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                </label>
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Save Settings</button>
        </div>
    </div>
</form>
@endsection
