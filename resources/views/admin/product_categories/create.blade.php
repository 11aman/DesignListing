@extends('layouts.admin')

@section('content')
<h1>Create Product Category</h1>

<form action="{{ route('admin.product_categories.store') }}" method="POST">
    @csrf
    <label for="name">Category Name</label>
    <input type="text" name="name" id="name" required>

    <label for="parent_id">Parent Category</label>
    <select name="parent_id" id="parent_id">
        <option value="">None</option>
        @foreach ($parentCategories as $parentCategory)
            <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
        @endforeach
    </select>

    <button type="submit">Create</button>
</form>
@endsection
