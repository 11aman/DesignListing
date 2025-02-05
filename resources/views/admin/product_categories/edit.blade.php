@extends('layouts.admin')

@section('content')
<h1>Edit Product Category</h1>

<form action="{{ route('admin.product_categories.update', $productCategory->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="name">Category Name</label>
    <input type="text" name="name" id="name" value="{{ old('name', $productCategory->name) }}" required>

    <label for="parent_id">Parent Category</label>
    <select name="parent_id" id="parent_id">
        <option value="">None</option>
        @foreach ($parentCategories as $parentCategory)
            <option value="{{ $parentCategory->id }}" {{ $productCategory->parent_id == $parentCategory->id ? 'selected' : '' }}>
                {{ $parentCategory->name }}
            </option>
        @endforeach
    </select>

    <button type="submit">Update</button>
</form>
@endsection
