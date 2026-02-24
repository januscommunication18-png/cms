@extends('admin.layouts.admin')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.client-passwords.index') }}" class="text-gray-500 hover:text-gray-700">&larr; Back to Client Passwords</a>
</div>

<h1 class="text-3xl font-bold mb-8">Edit Client Password</h1>

<form action="{{ route('admin.client-passwords.update', $clientPassword) }}" method="POST" class="max-w-3xl">
    @csrf
    @method('PUT')

    <div class="bg-white rounded-lg shadow p-6 space-y-6">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Client Name *</label>
            <input type="text" name="name" id="name" value="{{ old('name', $clientPassword->name) }}" required
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                placeholder="e.g., John Doe, Acme Corp">
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="text" name="password" id="password"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                placeholder="Leave blank to keep current password">
            <p class="mt-1 text-xs text-gray-500">Leave blank to keep the current password.</p>
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $clientPassword->is_active) ? 'checked' : '' }}
                    class="rounded border-gray-300 text-blue-500 focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-700">Active</span>
            </label>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-3">Assign Projects / Case Studies</label>
            <p class="text-sm text-gray-500 mb-4">Select which case studies this client can access:</p>

            <div class="border border-gray-200 rounded-lg max-h-64 overflow-y-auto p-4 space-y-3">
                @forelse($projects as $project)
                    <label class="flex items-start cursor-pointer hover:bg-gray-50 p-2 rounded">
                        <input type="checkbox" name="projects[]" value="{{ $project->id }}"
                            {{ in_array($project->id, old('projects', $assignedProjects)) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-blue-500 focus:ring-blue-500 mt-0.5">
                        <div class="ml-3">
                            <span class="text-sm font-medium text-gray-900">{{ $project->title }}</span>
                            @if($project->category)
                                <span class="text-xs text-gray-500 ml-2">({{ $project->category->name }})</span>
                            @endif
                        </div>
                    </label>
                @empty
                    <p class="text-sm text-gray-500">No projects available. Create some projects first.</p>
                @endforelse
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Update Client Password</button>
        </div>
    </div>
</form>
@endsection
