<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientPassword;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientPasswordController extends Controller
{
    public function index()
    {
        $clientPasswords = ClientPassword::withCount('projects')->orderBy('name')->paginate(10);
        return view('admin.client-passwords.index', compact('clientPasswords'));
    }

    public function create()
    {
        $projects = Project::orderBy('title')->get();
        return view('admin.client-passwords.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:4',
            'is_active' => 'boolean',
            'projects' => 'nullable|array',
            'projects.*' => 'exists:projects,id',
        ]);

        $clientPassword = ClientPassword::create([
            'name' => $validated['name'],
            'password' => Hash::make($validated['password']),
            'is_active' => $request->boolean('is_active'),
        ]);

        if (!empty($validated['projects'])) {
            $clientPassword->projects()->sync($validated['projects']);
        }

        return redirect()->route('admin.client-passwords.index')
            ->with('success', 'Client password created successfully.');
    }

    public function edit(ClientPassword $clientPassword)
    {
        $projects = Project::orderBy('title')->get();
        $assignedProjects = $clientPassword->projects->pluck('id')->toArray();
        return view('admin.client-passwords.edit', compact('clientPassword', 'projects', 'assignedProjects'));
    }

    public function update(Request $request, ClientPassword $clientPassword)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:4',
            'is_active' => 'boolean',
            'projects' => 'nullable|array',
            'projects.*' => 'exists:projects,id',
        ]);

        $clientPassword->name = $validated['name'];
        $clientPassword->is_active = $request->boolean('is_active');

        if (!empty($validated['password'])) {
            $clientPassword->password = Hash::make($validated['password']);
        }

        $clientPassword->save();
        $clientPassword->projects()->sync($validated['projects'] ?? []);

        return redirect()->route('admin.client-passwords.index')
            ->with('success', 'Client password updated successfully.');
    }

    public function destroy(ClientPassword $clientPassword)
    {
        $clientPassword->projects()->detach();
        $clientPassword->delete();

        return redirect()->route('admin.client-passwords.index')
            ->with('success', 'Client password deleted successfully.');
    }
}
