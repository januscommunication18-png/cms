<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use App\Models\ClientPassword;
use App\Models\ProjectVisit;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProjectController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('order')->get();

        $settings = [
            'site_title' => SiteSetting::get('site_title', 'Rohit Philip'),
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

        return view('case-studies', compact('categories', 'projects', 'settings'));
    }

    public function show(string $slug)
    {
        $project = Project::where('slug', $slug)->withCount('clientPasswords')->firstOrFail();

        // Check if project is protected (has client passwords assigned)
        $isProtected = $project->client_passwords_count > 0;

        // Check if client is logged in and has access to this project
        if (session()->has('client_password_id')) {
            $clientPassword = ClientPassword::find(session('client_password_id'));
            if ($clientPassword) {
                // Check if the client has access to this project
                $hasAccess = $clientPassword->projects()->where('projects.id', $project->id)->exists();
                if (!$hasAccess && $isProtected) {
                    abort(403, 'You do not have access to this case study.');
                }
            }
        } else if ($isProtected && !session()->has('project_access_' . $project->id)) {
            // Project is protected and user hasn't entered password
            $settings = [
                'site_title' => SiteSetting::get('site_title', 'Rohit Philip'),
                'linkedin_url' => SiteSetting::get('linkedin_url', '#'),
            ];
            return view('project-password', compact('project', 'settings'));
        }

        // Get next project (only from accessible projects)
        if (session()->has('client_password_id')) {
            $clientPassword = ClientPassword::find(session('client_password_id'));
            if ($clientPassword) {
                $clientProjects = $clientPassword->projects()->orderBy('client_password_project.id')->get();
                $currentIndex = $clientProjects->search(function ($p) use ($project) {
                    return $p->id === $project->id;
                });
                $nextProject = $clientProjects->get($currentIndex + 1) ?? $clientProjects->first();
                // Don't show same project as next
                if ($nextProject && $nextProject->id === $project->id) {
                    $nextProject = null;
                }
            } else {
                $nextProject = $this->getNextAccessibleProject($project->id);
            }
        } else {
            $nextProject = $this->getNextAccessibleProject($project->id);
        }

        $settings = [
            'site_title' => SiteSetting::get('site_title', 'Rohit Philip'),
            'linkedin_url' => SiteSetting::get('linkedin_url', '#'),
        ];

        return view('project', compact('project', 'nextProject', 'settings'));
    }

    /**
     * Get the next accessible project (not protected or already unlocked)
     */
    private function getNextAccessibleProject($currentProjectId)
    {
        return Project::where('id', '!=', $currentProjectId)
            ->withCount('clientPasswords')
            ->orderBy('order')
            ->get()
            ->filter(function ($project) {
                // If not protected (no client passwords), show it
                if ($project->client_passwords_count == 0) {
                    return true;
                }
                // If protected, only show if user has entered the password
                return session()->has('project_access_' . $project->id);
            })
            ->first();
    }

    public function verifyPassword(Request $request, string $slug)
    {
        $project = Project::where('slug', $slug)->with('clientPasswords')->firstOrFail();

        $request->validate([
            'visitor_name' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        // Check password against all client passwords assigned to this project
        $validClient = null;
        foreach ($project->clientPasswords as $clientPassword) {
            if ($clientPassword->is_active && Hash::check($request->password, $clientPassword->password)) {
                $validClient = $clientPassword;
                break;
            }
        }

        if ($validClient) {
            // Log the visit
            ProjectVisit::create([
                'project_id' => $project->id,
                'visitor_name' => $request->visitor_name,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            session()->put('project_access_' . $project->id, true);
            session()->put('visitor_name', $request->visitor_name);

            return redirect()->route('project.show', $slug);
        }

        return back()->withErrors(['password' => 'Incorrect password.'])->withInput();
    }
}
