@extends('admin.layouts.admin')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.categories.index') }}" class="text-gray-500 hover:text-gray-700">&larr; Back to Categories</a>
</div>

<h1 class="text-3xl font-bold mb-8">Edit Category</h1>

<form action="{{ route('admin.categories.update', $category) }}" method="POST" class="max-w-lg">
    @csrf
    @method('PUT')

    <div class="bg-white rounded-lg shadow p-6 space-y-6">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
            <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Order</label>
            <input type="number" name="order" id="order" value="{{ old('order', $category->order) }}"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="pt-4">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Update Category</button>
        </div>
    </div>
</form>
@endsection
