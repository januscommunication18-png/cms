<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;
use App\Models\ClientPassword;
use App\Services\ContentBlockService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('category')->withCount('clientPasswords')->orderBy('order')->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $categories = Category::orderBy('order')->get();
        $clientPasswords = ClientPassword::orderBy('name')->get();
        $blockTypes = ContentBlockService::getBlockTypes();
        $project = new Project(); // Empty project for the block builder
        return view('admin.projects.create', compact('categories', 'clientPasswords', 'blockTypes', 'project'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content_legacy' => 'nullable|string',
            'content_blocks' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|string',
            'client_name' => 'nullable|string|max:255',
            'background_color' => 'nullable|string|max:20',
            'order' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_protected' => 'boolean',
            'password' => 'nullable|string|min:4',
            'image' => 'nullable|image|max:2048',
            'banner_image' => 'nullable|image|max:4096',
            'use_cover_as_banner' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['tags'] = $request->tags ? array_map('trim', explode(',', $request->tags)) : [];
        $validated['background_color'] = $request->background_color ?? '#f9fafb';
        $validated['order'] = $request->order ?? 0;
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_protected'] = $request->boolean('is_protected');
        $validated['use_cover_as_banner'] = $request->boolean('use_cover_as_banner');

        // Process content blocks
        if ($request->content_blocks) {
            $validated['content_blocks'] = json_decode($request->content_blocks, true);
        }

        if ($request->password) {
            $validated['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $request->file('banner_image')->store('projects', 'public');
        }

        $project = Project::create($validated);

        // Sync client passwords
        $clientPasswordIds = $request->input('client_passwords', []);
        $project->clientPasswords()->sync($clientPasswordIds);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        $categories = Category::orderBy('order')->get();
        $clientPasswords = ClientPassword::orderBy('name')->get();
        $assignedClientIds = $project->clientPasswords->pluck('id')->toArray();
        $blockTypes = ContentBlockService::getBlockTypes();
        return view('admin.projects.edit', compact('project', 'categories', 'clientPasswords', 'assignedClientIds', 'blockTypes'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content_legacy' => 'nullable|string',
            'content_blocks' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|string',
            'client_name' => 'nullable|string|max:255',
            'background_color' => 'nullable|string|max:20',
            'order' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_protected' => 'boolean',
            'password' => 'nullable|string|min:4',
            'image' => 'nullable|image|max:2048',
            'banner_image' => 'nullable|image|max:4096',
            'use_cover_as_banner' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['tags'] = $request->tags ? array_map('trim', explode(',', $request->tags)) : [];
        $validated['background_color'] = $request->background_color ?? '#f9fafb';
        $validated['order'] = $request->order ?? 0;
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_protected'] = $request->boolean('is_protected');
        $validated['use_cover_as_banner'] = $request->boolean('use_cover_as_banner');

        // Process content blocks
        if ($request->content_blocks) {
            $validated['content_blocks'] = json_decode($request->content_blocks, true);
        }

        if ($request->password) {
            $validated['password'] = Hash::make($request->password);
        } elseif (!$request->is_protected) {
            $validated['password'] = null;
        } else {
            unset($validated['password']);
        }

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        if ($request->hasFile('banner_image')) {
            if ($project->banner_image) {
                Storage::disk('public')->delete($project->banner_image);
            }
            $validated['banner_image'] = $request->file('banner_image')->store('projects', 'public');
        }

        $project->update($validated);

        // Sync client passwords
        $clientPasswordIds = $request->input('client_passwords', []);
        $project->clientPasswords()->sync($clientPasswordIds);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}
