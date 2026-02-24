@extends('admin.layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold">Case Study Visits</h1>
        <p class="text-gray-500 mt-1">Track who is viewing your password-protected case studies</p>
    </div>
</div>

<!-- Filters -->
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <form action="{{ route('admin.project-visits.index') }}" method="GET" class="flex flex-wrap gap-4 items-end">
        <div>
            <label for="project_id" class="block text-sm font-medium text-gray-700 mb-1">Case Study</label>
            <select name="project_id" id="project_id" class="border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">All Case Studies</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>
                        {{ $project->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="from_date" class="block text-sm font-medium text-gray-700 mb-1">From Date</label>
            <input type="date" name="from_date" id="from_date" value="{{ request('from_date') }}"
                class="border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="to_date" class="block text-sm font-medium text-gray-700 mb-1">To Date</label>
            <input type="date" name="to_date" id="to_date" value="{{ request('to_date') }}"
                class="border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Filter
            </button>
            <a href="{{ route('admin.project-visits.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">
                Reset
            </a>
        </div>
    </form>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
@endif

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-sm text-gray-500">Total Visits</p>
        <p class="text-3xl font-bold text-gray-900">{{ $visits->total() }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-sm text-gray-500">Today's Visits</p>
        <p class="text-3xl font-bold text-blue-600">{{ \App\Models\ProjectVisit::whereDate('created_at', today())->count() }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-sm text-gray-500">This Week</p>
        <p class="text-3xl font-bold text-green-600">{{ \App\Models\ProjectVisit::where('created_at', '>=', now()->startOfWeek())->count() }}</p>
    </div>
</div>

<!-- Visits Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Visitor Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Case Study</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP Address</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($visits as $visit)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $visit->visitor_name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('project.show', $visit->project->slug) }}" target="_blank" class="text-sm text-blue-600 hover:underline">
                            {{ $visit->project->title }}
                        </a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm text-gray-500">{{ $visit->ip_address }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $visit->created_at->format('M d, Y') }}</div>
                        <div class="text-sm text-gray-500">{{ $visit->created_at->format('h:i A') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <form action="{{ route('admin.project-visits.destroy', $visit) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this visit record?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <p class="text-lg font-medium">No visits recorded yet</p>
                        <p class="text-sm">When visitors access your password-protected case studies, they'll appear here.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $visits->links() }}
</div>
@endsection
