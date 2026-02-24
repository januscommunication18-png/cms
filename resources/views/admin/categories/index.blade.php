@extends('admin.layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold">Categories</h1>
    <a href="{{ route('admin.categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Category</a>
</div>

<div class="bg-white rounded-lg shadow">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr class="text-left text-gray-500 text-sm">
                <th class="px-6 py-3">Name</th>
                <th class="px-6 py-3">Slug</th>
                <th class="px-6 py-3">Projects</th>
                <th class="px-6 py-3">Order</th>
                <th class="px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium">{{ $category->name }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $category->slug }}</td>
                    <td class="px-6 py-4">{{ $category->projects_count }}</td>
                    <td class="px-6 py-4">{{ $category->order }}</td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure? Projects in this category will have no category.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">No categories found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
