<?php

namespace App\Http\Controllers;

use App\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Finish;
use App\Models\Size;
use App\Models\Structure;
use App\Models\DesignCategory;
use App\Models\Species;
use App\Models\Color;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function create()
    {
        $categories = ProductCategory::whereNull('parent_id')->get();
        $subCategories = ProductCategory::whereNotNull('parent_id')->get();
        $finishes = Finish::all();
        $sizes = Size::all();
        $structures = Structure::all();
        $designCategories = DesignCategory::all();
        $species = Species::all();
        $colors = Color::all();
        return view('products.create', compact(
            'categories', 'finishes', 'sizes', 'structures', 'designCategories', 'species', 'colors'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'product_category_id' => 'required|exists:product_categories,id',
            'finish_id' => 'required|exists:finishes,id',
            'size_id' => 'required|exists:sizes,id',
            'structure_id' => 'required|exists:structures,id',
            'design_category_id' => 'required|exists:design_categories,id',
            'species_id' => 'required|exists:species,id',
            'color_id' => 'required|exists:colors,id',
        ]);

        Product::create($request->all());
        return redirect()->route('designs')->with('success', 'Product created successfully.');
    }

    // Show the form for editing the specified product
    public function edit(Product $product)
{
    $categories = ProductCategory::whereNull('parent_id')->get();
    $subCategories = ProductCategory::whereNotNull('parent_id')->get();
    $finishes = Finish::all();
    $sizes = Size::all();
    $structures = Structure::all();
    $designCategories = DesignCategory::all();
    $species = Species::all();
    $colors = Color::all();
    return view('products.create', compact(
        'product', 'categories', 'subCategories', 'finishes', 'sizes', 'structures', 'designCategories', 'species', 'colors'
    ));
}

    // Update the specified product in the database
    public function update(Request $request, Product $product)
    {
      
        $request->validate([
            'name' => 'required|string|max:255',
            'product_category_id' => 'required|exists:product_categories,id',
            'finish_id' => 'required|exists:finishes,id',
            'size_id' => 'required|exists:sizes,id',
            'structure_id' => 'required|exists:structures,id',
            'design_category_id' => 'required|exists:design_categories,id',
            'species_id' => 'required|exists:species,id',
            'color_id' => 'required|exists:colors,id',
        ]);

        $product->update($request->all());
        return redirect()->route('designs')->with('success', 'Product updated successfully.');
    }

    // Remove the specified product from the database
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('designs')->with('success', 'Product deleted successfully.');
    }


    // Fetch Subcategories for a given Category
    public function getSubcategories($categoryId)
    {
        $subcategories = ProductCategory::where('parent_id', $categoryId)->get();
        return response()->json(['subcategories' => $subcategories]);
    }

    // Fetch Finishes for a given Category
    public function getFinishes($categoryId)
    {
        $finishes = Finish::whereHas('productCategories', function ($query) use ($categoryId) {
            $query->where('product_category_id', $categoryId);
        })->get();
        return response()->json(['finishes' => $finishes]);
    }
}