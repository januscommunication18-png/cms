<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Client;
use App\Models\SiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Create admin user
        User::updateOrCreate(
            ['email' => 'rohitcphilip@gmail.com'],
            [
                'name' => 'Rohit Philip',
                'password' => Hash::make('admin@123'),
                'email_verified_at' => now(),
            ]
        );

        // Site Settings
        SiteSetting::set('site_title', 'Rohit Philip');
        SiteSetting::set('site_tagline', 'Product Design & UX');
        SiteSetting::set('about_text', 'A product designer who cares about solving complex problems by deeply understanding the people around me. I believe that design starts with people.');
        SiteSetting::set('linkedin_url', 'https://linkedin.com/in/rohitphilip');
        SiteSetting::set('email', 'hello@rohitphilip.com');

        // Categories
        $categories = [
            ['name' => 'Health Care', 'slug' => 'health-care', 'order' => 1],
            ['name' => 'Social Media', 'slug' => 'social-media', 'order' => 2],
            ['name' => 'Salesforce', 'slug' => 'salesforce', 'order' => 3],
            ['name' => 'Payroll & Accounting', 'slug' => 'payroll-accounting', 'order' => 4],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Clients
        $clients = [
            ['name' => 'CVS', 'order' => 1],
            ['name' => 'Airbnb', 'order' => 2],
            ['name' => 'Wells Fargo', 'order' => 3],
            ['name' => 'ADP', 'order' => 4],
            ['name' => 'BNY', 'order' => 5],
            ['name' => 'Fannie Mae', 'order' => 6],
            ['name' => 'HighMark', 'order' => 7],
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }

    }
}
