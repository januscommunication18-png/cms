<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;
use App\Models\Client;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects' => Project::count(),
            'categories' => Category::count(),
            'clients' => Client::count(),
            'featured' => Project::where('is_featured', true)->count(),
        ];

        $recentProjects = Project::with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentProjects'));
    }
}
