<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use App\Models\Client;
use App\Models\ClientPassword;
use App\Models\SiteSetting;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('order')->get();
        $clients = Client::orderBy('order')->get();

        $settings = [
            'site_title' => SiteSetting::get('site_title', 'Rohit Philip'),
            'site_tagline' => SiteSetting::get('site_tagline', 'Product Design & UX'),
            'about_text' => SiteSetting::get('about_text', 'A product designer who cares about solving complex problems by deeply understanding the people around me.'),
            'linkedin_url' => SiteSetting::get('linkedin_url', '#'),
        ];

        // Check if client is logged in via client password system
        if (session()->has('client_password_id')) {
            $clientPassword = ClientPassword::find(session('client_password_id'));
            if ($clientPassword) {
                // Get only assigned projects for this client
                $projects = $clientPassword->projects()
                    ->with('category')
                    ->withCount('clientPasswords')
                    ->orderBy('client_password_project.id')
                    ->get();
            } else {
                // Invalid session, clear it
                session()->forget(['client_password_id', 'client_name']);
                $projects = Project::with('category')->withCount('clientPasswords')->orderBy('order')->get();
            }
        } else {
            // Show all projects (protected ones will show password form in the view)
            $projects = Project::with('category')->withCount('clientPasswords')->orderBy('order')->get();
        }

        return view('home', compact('categories', 'projects', 'clients', 'settings'));
    }
}
