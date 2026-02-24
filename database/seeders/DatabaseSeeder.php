<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Project;
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

        // Sample Projects
        $projects = [
            [
                'title' => 'Healthcare Patient Portal',
                'slug' => 'healthcare-patient-portal',
                'description' => 'Redesigning the patient experience for a major healthcare provider.',
                'category_id' => 1,
                'tags' => ['Mobile App', 'B2C', 'Healthcare'],
                'client_name' => 'CVS',
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'title' => 'Social Media Dashboard',
                'slug' => 'social-media-dashboard',
                'description' => 'Analytics platform for social media managers.',
                'category_id' => 2,
                'tags' => ['Web App', 'Data Visualization', 'B2B'],
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'title' => 'Enterprise CRM Enhancement',
                'slug' => 'enterprise-crm-enhancement',
                'description' => 'Improving Salesforce workflow for enterprise sales teams.',
                'category_id' => 3,
                'tags' => ['Salesforce', 'Enterprise', 'B2B'],
                'client_name' => 'Wells Fargo',
                'order' => 3,
            ],
            [
                'title' => 'Payroll Management System',
                'slug' => 'payroll-management-system',
                'description' => 'Streamlined payroll processing for small businesses.',
                'category_id' => 4,
                'tags' => ['Web App', 'B2B', 'Fintech'],
                'client_name' => 'ADP',
                'is_featured' => true,
                'order' => 4,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
