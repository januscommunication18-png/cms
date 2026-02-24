<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share settings with all views using frontend layout
        View::composer('layouts.frontend', function ($view) {
            $settings = $view->getData()['settings'] ?? [];

            // Ensure font_name is always available
            if (!isset($settings['font_name'])) {
                $settings['font_name'] = SiteSetting::get('font_name', 'Messina Sans');
            }

            // Also ensure other common settings
            $settings = array_merge([
                'site_title' => SiteSetting::get('site_title', 'Rohit Philip'),
                'site_tagline' => SiteSetting::get('site_tagline', 'Product Design & UX'),
                'linkedin_url' => SiteSetting::get('linkedin_url', ''),
                'font_name' => SiteSetting::get('font_name', 'Messina Sans'),
            ], $settings);

            $view->with('settings', $settings);
        });
    }
}
