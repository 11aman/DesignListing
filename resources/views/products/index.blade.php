<x-app-layout>
<div class="container">
    <h1>Products</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Create New Product</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Finish</th>
                <th>Size</th>
                <th>Structure</th>
                <th>Design Category</th>
                <th>Species</th>
                <th>Color</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->Category->name }}</td>
                    <td>{{ $product->finish->name }}</td>
                    <td>{{ $product->size->size_feet }} ({{ $product->size->size_mm }})</td>
                    <td>{{ $product->structure->name }}</td>
                    <td>{{ $product->designCategory->name }}</td>
                    <td>{{ $product->species->name }}</td>
                    <td>{{ $product->color->name }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>