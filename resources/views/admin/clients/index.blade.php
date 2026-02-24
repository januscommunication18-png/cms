@extends('admin.layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold">Clients</h1>
    <a href="{{ route('admin.clients.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Client</a>
</div>

<div class="bg-white rounded-lg shadow">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr class="text-left text-gray-500 text-sm">
                <th class="px-6 py-3">Logo</th>
                <th class="px-6 py-3">Name</th>
                <th class="px-6 py-3">Website</th>
                <th class="px-6 py-3">Order</th>
                <th class="px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clients as $client)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-6 py-4">
                        @if($client->logo)
                            <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}" class="h-10 object-contain">
                        @else
                            <div class="w-16 h-10 bg-gray-200 rounded flex items-center justify-center text-gray-400 text-xs">No logo</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-medium">{{ $client->name }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $client->website ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $client->order }}</td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.clients.edit', $client) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                            <form action="{{ route('admin.clients.destroy', $client) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">No clients found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
