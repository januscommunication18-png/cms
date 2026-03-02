<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;
use App\Models\Client;
use Illuminate\Support\Facades\File;

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

    public function syncStorage()
    {
        try {
            $sourcePath = storage_path('app/public');
            $destinationPath = base_path('../public_html/storage');

            // Check if source exists
            if (!File::isDirectory($sourcePath)) {
                return back()->with('error', 'Source storage directory not found.');
            }

            // Create destination if it doesn't exist
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            // Copy all files recursively
            File::copyDirectory($sourcePath, $destinationPath);

            return back()->with('success', 'Storage synced successfully! All images are now accessible.');
        } catch (\Exception $e) {
            return back()->with('error', 'Sync failed: ' . $e->getMessage());
        }
    }
}
