<div>
@if (session('success'))
    <div id="success-message" class="mb-4 p-4 bg-green-100 text-green-700 border border-green-400 rounded">
        <ul class="list-disc pl-5">
            <li>{{ session('success') }}</li>
        </ul>
    </div>
@endif

@if ($errors->any())
    <div id="error-message" class="mb-4 p-4 bg-red-100 text-red-700 border border-red-400 rounded">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h2 class="text-xl font-bold mb-4">Add and Import/Export Products</h2>

    <div class="flex justify-between gap-4 mb-2" style="height:100px">
        <div>    
            <a href="{{ route('products.create') }}" class="text-xs bg-gray-600 hover:bg-gray-700 text-white py-3 px-6 rounded-lg shadow-md transition duration-300 transform hover:scale-105 mt-4 block">
            Add Product
            </a>
        </div>
        <div>
            <button wire:click="export('json')" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg shadow-md transition duration-300 transform hover:scale-105">Export as JSON</button>
            <button wire:click="export('csv')" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg shadow-md transition duration-300 transform hover:scale-105">Export as CSV</button>
        </div>
            @livewire('import-export')
    </div>


    <div class="mb-8 p-4 bg-gray-100 rounded-lg">
        <h2 class="text-xl font-bold mb-4">Filters</h2>

        <!-- Category Dropdown -->
        <select wire:model.lazy="selectedCategory">
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <!-- Subcategory Dropdown -->
        @if(!empty($subCategories))
            <select wire:model.lazy="selectedSubCategory">
                <option value="">Select Subcategory</option>
                @foreach($subCategories as $subcategory)
                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach
            </select>
        @endif

        <!-- Finish Filter -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Finish</label>
            <select wire:model.lazy="selectedFinish" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                <option value="">Select Finish</option>
                @foreach ($finishes as $finish)
                    <option value="{{ $finish->id }}">{{ $finish->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Size Filter -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Size</label>
            <select wire:model.lazy="selectedSize" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                <option value="">Select Size</option>
                @foreach ($sizes as $size)
                    <option value="{{ $size->id }}">{{ $size->size_feet }} ({{ $size->size_mm }})</option>
                @endforeach
            </select>
        </div>

        <!-- Additional Filters-->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Structure</label>
                <select wire:model.lazy="selectedStructure" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    <option value="">Select Structure</option>
                    @foreach ($structures as $structure)
                        <option value="{{ $structure->id }}">{{ $structure->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Design Category</label>
                <select wire:model.lazy="selectedDesignCategory" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    <option value="">Select Design Category</option>
                    @foreach ($designCategories as $designCategory)
                        <option value="{{ $designCategory->id }}">{{ $designCategory->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Species</label>
                <select wire:model.lazy="selectedSpecies" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    <option value="">Select Species</option>
                    @foreach ($species as $speciesItem)
                        <option value="{{ $speciesItem->id }}">{{ $speciesItem->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Color</label>
                <select wire:model.lazy="selectedColor" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    <option value="">Select Color</option>
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <!-- Product List Section -->
    <div class="mt-8">
        <h2 class="text-xl font-bold mb-4">Products</h2>

        @if ($products->isEmpty())
            <p class="text-gray-600">No products found.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($products as $product)
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold">{{ $product->name }}<span  style="float: right;"><a href="{{ route('products.edit', $product->id) }}">edit</a> 
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">delete</button>
                        </form></span>
                    </h3>
                        <p class="text-sm text-gray-600">Category: {{ $product->category->name }}</p>
                        @if($product->subCategory) <p class="text-sm text-gray-600">SubCategory: {{ $product->subCategory->name }}</p> @endif
                        <p class="text-sm text-gray-600">Finish: {{ $product->finish->name }}</p>
                        <p class="text-sm text-gray-600">Size: {{ $product->size->size_feet }} ({{ $product->size->size_mm }})</p>
                        <p class="text-sm text-gray-600">Structure: {{ $product->structure->name }}</p>
                        <p class="text-sm text-gray-600">Design Category: {{ $product->designCategory->name }}</p>
                        <p class="text-sm text-gray-600">Species: {{ $product->species->name }}</p>
                        <p class="text-sm text-gray-600">Color: {{ $product->color->name }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<script>
    if (document.getElementById('success-message')) {
        setTimeout(function () {
            document.getElementById('success-message').style.display = 'none';
        }, 1000); 
    }

    if (document.getElementById('error-message')) {
        setTimeout(function () {
            document.getElementById('error-message').style.display = 'none';
        }, 1000);
    }
</script>
