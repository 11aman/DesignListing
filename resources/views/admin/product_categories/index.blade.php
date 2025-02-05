@extends('layouts.admin')

@section('content')
    <h1 class="text-3xl font-semibold mb-6 text-gray-800">Product Categories</h1>

    <a href="{{ route('admin.product_categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-md mb-6 inline-block">
        Create Category
    </a>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-6 py-3 text-left">Category Name</th>
                    <th class="px-6 py-3 text-left">Parent Category</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($categories as $category)
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-6 py-4">{{ $category->name }}</td>
                    <td class="px-6 py-4">{{ $category->parent ? $category->parent->name : 'No Parent' }}</td>
                    <td class="px-6 py-4 flex space-x-4">
                        <a href="{{ route('admin.product_categories.edit', $category->id) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        <form action="{{ route('admin.product_categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
