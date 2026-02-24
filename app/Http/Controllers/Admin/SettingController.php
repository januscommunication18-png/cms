<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'site_title' => SiteSetting::get('site_title', 'Rohit Philip'),
            'site_tagline' => SiteSetting::get('site_tagline', 'Product Design & UX'),
            'about_text' => SiteSetting::get('about_text', ''),
            'linkedin_url' => SiteSetting::get('linkedin_url', ''),
            'email' => SiteSetting::get('email', ''),
            'font_name' => SiteSetting::get('font_name', 'Messina Sans'),
            'security_code_enabled' => SiteSetting::get('security_code_enabled', '1'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_title' => 'required|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'about_text' => 'nullable|string',
            'linkedin_url' => 'nullable|url|max:255',
            'email' => 'nullable|email|max:255',
            'font_name' => 'nullable|string|max:255',
            'security_code_enabled' => 'nullable|in:0,1',
        ]);

        // Handle checkbox - if not present, it's disabled
        $validated['security_code_enabled'] = $request->has('security_code_enabled') ? '1' : '0';

        foreach ($validated as $key => $value) {
            SiteSetting::set($key, $value);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }
}
