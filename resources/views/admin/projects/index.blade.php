@extends('admin.layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold">Projects</h1>
    <a href="{{ route('admin.projects.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Project</a>
</div>

<div class="bg-white rounded-lg shadow">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr class="text-left text-gray-500 text-sm">
                <th class="px-6 py-3">Order</th>
                <th class="px-6 py-3">Image</th>
                <th class="px-6 py-3">Title</th>
                <th class="px-6 py-3">Category</th>
                <th class="px-6 py-3">Status</th>
                <th class="px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $project)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full text-sm font-medium text-gray-600">
                            {{ $project->order ?? '-' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-16 h-12 object-cover rounded">
                        @else
                            <div class="w-16 h-12 bg-gray-200 rounded flex items-center justify-center text-gray-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-medium">{{ $project->title }}</td>
                    <td class="px-6 py-4">{{ $project->category?->name ?? '-' }}</td>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-1">
                            @if($project->client_passwords_count > 0)
                                <span class="inline-flex items-center bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                    Private
                                </span>
                            @else
                                <span class="inline-flex items-center bg-green-100 text-green-800 text-xs px-2 py-1 rounded">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Public
                                </span>
                            @endif
                            @if($project->is_featured)
                                <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">Featured</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.projects.edit', $project) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">No projects found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $projects->links() }}
</div>
@endsection
