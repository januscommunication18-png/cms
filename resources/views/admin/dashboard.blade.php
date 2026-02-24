@extends('admin.layouts.admin')

@section('content')
<h1 class="text-3xl font-bold mb-8">Dashboard</h1>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-gray-500 text-sm">Total Projects</div>
        <div class="text-3xl font-bold">{{ $stats['projects'] }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-gray-500 text-sm">Categories</div>
        <div class="text-3xl font-bold">{{ $stats['categories'] }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-gray-500 text-sm">Clients</div>
        <div class="text-3xl font-bold">{{ $stats['clients'] }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-gray-500 text-sm">Featured Projects</div>
        <div class="text-3xl font-bold">{{ $stats['featured'] }}</div>
    </div>
</div>

<!-- Recent Projects -->
<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b flex justify-between items-center">
        <h2 class="text-xl font-semibold">Recent Projects</h2>
        <a href="{{ route('admin.projects.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add New</a>
    </div>
    <div class="p-6">
        @if($recentProjects->count() > 0)
            <table class="w-full">
                <thead>
                    <tr class="text-left text-gray-500 text-sm">
                        <th class="pb-3">Title</th>
                        <th class="pb-3">Category</th>
                        <th class="pb-3">Status</th>
                        <th class="pb-3">Created</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentProjects as $project)
                        <tr class="border-t">
                            <td class="py-3">
                                <a href="{{ route('admin.projects.edit', $project) }}" class="text-blue-500 hover:underline">{{ $project->title }}</a>
                            </td>
                            <td class="py-3">{{ $project->category?->name ?? '-' }}</td>
                            <td class="py-3">
                                @if($project->is_featured)
                                    <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">Featured</span>
                                @endif
                                @if($project->is_protected)
                                    <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded">Protected</span>
                                @endif
                            </td>
                            <td class="py-3 text-gray-500 text-sm">{{ $project->created_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500">No projects yet. <a href="{{ route('admin.projects.create') }}" class="text-blue-500 hover:underline">Create your first project</a></p>
        @endif
    </div>
</div>
@endsection
