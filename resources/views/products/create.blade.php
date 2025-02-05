<x-app-layout>
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6 mt-6">
        <h1 class="text-2xl font-semibold mb-6 text-gray-800">
            {{ isset($product) ? 'Edit Product' : 'Create New Product' }}
        </h1>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-400 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}" method="POST" class="space-y-4">
            @csrf
            @if (isset($product))
                @method('PUT')
            @endif

            <!-- Product Name -->
            <div>
                <label for="name" class="block text-gray-700 font-medium">Product Name</label>
                <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-300" value="{{ old('name', $product->name ?? '') }}" required>
            </div>

            <!-- Product Category -->
            <div>
                <label for="product_category_id" class="block text-gray-700 font-medium">Product Category</label>
                <select name="product_category_id" id="product_category_id" class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-300" required>
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ (isset($product) && $product->product_category_id == $category->id) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Product Subcategory-->
            <div>
                <label for="sub_category_id" class="block text-gray-700 font-medium">Subcategory</label>
                <select name="sub_category_id" id="sub_category_id" data-selected="{{ $product->sub_category_id ?? '' }}"  class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-300">
                    <option value="">Select Subcategory</option>
                    @if (isset($product) && $product->sub_category_id)
                        @foreach ($subCategories as $subCategory)
                            <option value="{{ $subCategory->id }}" {{ $product->sub_category_id == $subCategory->id ? 'selected' : '' }}>
                                {{ $subCategory->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

            <!-- Finish-->
            <div>
                <label for="finish_id" class="block text-gray-700 font-medium">Finish</label>
                <select name="finish_id" id="finish_id" data-selected="{{ $product->finish_id ?? '' }}" class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-300" required>
                    <option value="">Select Finish</option>
                    @if (isset($product) && $product->finish_id)
                        @foreach ($finishes as $finish)
                            <option value="{{ $finish->id }}" {{ $product->finish_id == $finish->id ? 'selected' : '' }}>
                                {{ $finish->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

            <!-- Size -->
            <div>
                <label for="size_id" class="block text-gray-700 font-medium">Size</label>
                <select name="size_id" id="size_id" class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-300" required>
                    <option value="">Select Size</option>
                    @foreach ($sizes as $size)
                        <option value="{{ $size->id }}" {{ (isset($product) && $product->size_id == $size->id) ? 'selected' : '' }}>
                            {{ $size->size_feet }} ({{ $size->size_mm }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Structure -->
            <div>
                <label for="structure_id" class="block text-gray-700 font-medium">Structure</label>
                <select name="structure_id" id="structure_id" class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-300" required>
                    <option value="">Select Structure</option>
                    @foreach ($structures as $structure)
                        <option value="{{ $structure->id }}" {{ (isset($product) && $product->structure_id == $structure->id) ? 'selected' : '' }}>
                            {{ $structure->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Design Category -->
            <div>
                <label for="design_category_id" class="block text-gray-700 font-medium">Design Category</label>
                <select name="design_category_id" id="design_category_id" class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-300" required>
                    <option value="">Select Design Category</option>
                    @foreach ($designCategories as $designCategory)
                        <option value="{{ $designCategory->id }}" {{ (isset($product) && $product->design_category_id == $designCategory->id) ? 'selected' : '' }}>
                            {{ $designCategory->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Species -->
            <div>
                <label for="species_id" class="block text-gray-700 font-medium">Species</label>
                <select name="species_id" id="species_id" class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-300" required>
                    <option value="">Select Species</option>
                    @foreach ($species as $sp)
                        <option value="{{ $sp->id }}" {{ (isset($product) && $product->species_id == $sp->id) ? 'selected' : '' }}>
                            {{ $sp->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Color -->
            <div>
                <label for="color_id" class="block text-gray-700 font-medium">Color</label>
                <select name="color_id" id="color_id" class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-300" required>
                    <option value="">Select Color</option>
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}" {{ (isset($product) && $product->color_id == $color->id) ? 'selected' : '' }}>
                            {{ $color->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-200">
                {{ isset($product) ? 'Update Product' : 'Create Product' }}
            </button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
 $(document).ready(function () {
    function loadDependentData(categoryId, subCategoryId, finishId) {
        if (categoryId) {
            // Fetch Subcategories
            $.get(`/get-subcategories/${categoryId}`, function (response) {
                $('#sub_category_id').html('<option value="">Select Subcategory</option>');
                response.subcategories.forEach(subcategory => {
                    let selected = subcategory.id == subCategoryId ? 'selected' : '';
                    $('#sub_category_id').append(`<option value="${subcategory.id}" ${selected}>${subcategory.name}</option>`);
                });
            }).fail(() => alert('Failed to load subcategories.'));

            // Fetch Finishes
            $.get(`/get-finishes/${categoryId}`, function (response) {
                $('#finish_id').html('<option value="">Select Finish</option>');
                response.finishes.forEach(finish => {
                    let selected = finish.id == finishId ? 'selected' : '';
                    $('#finish_id').append(`<option value="${finish.id}" ${selected}>${finish.name}</option>`);
                });
            }).fail(() => alert('Failed to load finishes.'));
        }
    }


    let selectedCategory = $('#product_category_id').val();
    let selectedSubCategory = $('#sub_category_id').data('selected');
    let selectedFinish = $('#finish_id').data('selected');
    loadDependentData(selectedCategory, selectedSubCategory, selectedFinish);


    $('#product_category_id').change(function () {
        let categoryId = $(this).val();
        loadDependentData(categoryId, null, null);
    });
});

</script>


</x-app-layout>