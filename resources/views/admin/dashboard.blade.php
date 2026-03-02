@extends('admin.layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold">Dashboard</h1>

    {{-- Sync Storage Button --}}
    <form action="{{ route('admin.sync-storage') }}" method="POST" class="inline">
        @csrf
        <button type="submit"
            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition"
            onclick="this.disabled=true; this.innerHTML='<svg class=\'animate-spin h-5 w-5 mr-2\' viewBox=\'0 0 24 24\'><circle class=\'opacity-25\' cx=\'12\' cy=\'12\' r=\'10\' stroke=\'currentColor\' stroke-width=\'4\' fill=\'none\'></circle><path class=\'opacity-75\' fill=\'currentColor\' d=\'M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z\'></path></svg> Syncing...'; this.form.submit();">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Sync Storage
        </button>
    </form>
</div>

{{-- Flash Messages --}}
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 flex items-center justify-between">
        <span>{{ session('success') }}</span>
        <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">&times;</button>
    </div>
@endif
@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 flex items-center justify-between">
        <span>{{ session('error') }}</span>
        <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900">&times;</button>
    </div>
@endif

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
