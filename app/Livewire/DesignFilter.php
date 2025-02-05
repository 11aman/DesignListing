<?php

namespace App\Livewire;

use App\Models\Color;
use Livewire\Component;
use App\Models\ProductCategory;
use App\Models\Finish;
use App\Models\Size;
use App\Models\Structure;
use App\Models\Product;
use App\Models\DesignCategory;  // Import DesignCategory model
use App\Models\Species;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DesignFilter extends Component
{
    protected $listeners = ['productsImported' => 'render'];

    public $selectedCategory;
    public $selectedFinish;
    public $selectedSize;
    public $selectedStructure;
    public $selectedDesignCategory;
    public $selectedSpecies;
    public $selectedColor;
    public $selectedSubCategory;


    public $subCategories = [];
    public $finishes = [];
    public $sizes = [];
    public $structures = [];
    public $designCategories = []; 
    public $species = [];
    public $color = [];


    public function updated($propertyName, $value)
{
    Log::info("Property Updated: {$propertyName} = {$value}");

    if ($propertyName === 'selectedCategory') {
        $this->finishes = Finish::whereHas('productCategories', function ($query) use ($value) {
            $query->where('product_category_id', $value);
        })->get();
        $this->reset(['selectedFinish', 'selectedSize', 'selectedStructure']);
    }

    if ($propertyName === 'selectedFinish') {
        Log::info("Finish Updated: {$value}");

        $this->sizes = Size::whereHas('finishes', function ($query) use ($value) {
            $query->where('finish_id', $value);
        })->get();
        $this->reset(['selectedSize', 'selectedStructure']);
    }

    if ($propertyName === 'selectedSize') {
        $this->structures = Structure::whereHas('sizes', function ($query) use ($value) {
            $query->where('size_id', $value);
        })->get();
    }

    if ($propertyName === 'selectedCategory') {
        $this->subCategories = ProductCategory::where('parent_id', $value)->get();
        $this->selectedSubCategory = null;
        $this->selectedChildCategory = null;
    }

    // if ($propertyName === 'selectedSubCategory') {
    //     $this->childCategories = ProductCategory::where('parent_id', $value)->get();
    //     $this->selectedChildCategory = null;
    // }

    Log::info([
        'selectedCategory' => $this->selectedCategory,
        'selectedFinish' => $this->selectedFinish,
        'selectedSize' => $this->selectedSize,
        'selectedStructure' => $this->selectedStructure,
        'selectedDesignCategory' => $this->selectedDesignCategory,
        'selectedSpecies' => $this->selectedSpecies,
        'selectedColor' => $this->selectedColor,
        'selectedSubCategory' => $this->selectedSubCategory,
        // 'selectedChildCategory' => $this->selectedChildCategory,
    ]);
    
}

    
    public function render()
    {
        $categories = ProductCategory::whereNull('parent_id')->get();
        $this->designCategories = DesignCategory::all();
        $this->species = Species::all();
        $this->color = Color::all();

        $products = Product::query()
            ->when($this->selectedCategory, function ($query) {
                $categoryIds = ProductCategory::where('id', $this->selectedCategory)
                                            ->orWhere('parent_id', $this->selectedCategory)
                                            ->pluck('id')
                                            ->toArray();
                if (!empty($categoryIds)) {
                    $query->whereIn('product_category_id', $categoryIds);
                }
            })
            ->when($this->selectedSubCategory, fn($query) => $query->where('sub_category_id', $this->selectedSubCategory))
            ->when($this->selectedFinish, fn($query) => $query->where('finish_id', $this->selectedFinish))
            ->when($this->selectedSize, fn($query) => $query->where('size_id', $this->selectedSize))
            ->when($this->selectedStructure, fn($query) => $query->where('structure_id', $this->selectedStructure))
            ->when($this->selectedDesignCategory, fn($query) => $query->where('design_category_id', $this->selectedDesignCategory))
            ->when($this->selectedSpecies, fn($query) => $query->where('species_id', $this->selectedSpecies))
            ->when($this->selectedColor, fn($query) => $query->where('color_id', $this->selectedColor))
            ->get();

        return view('livewire.design-filter', [
            'categories' => $categories,
            'selectedSubCategory' => $this->subCategories,
            'products' => $products,
            'designCategories' => $this->designCategories,
            'species' => $this->species,
            'colors' => $this->color,
        ])->layout('layouts.app');
    }

    public function export($format)
    {
        $products = $this->getFilteredProducts();

        if ($format === 'json') {
            $filename = 'products_export.json';

        // Return a downloadable JSON file
        return new StreamedResponse(function () use ($products) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, json_encode($products, JSON_PRETTY_PRINT));
            fclose($handle);
        }, 200, [
            'Content-Type' => 'application/json',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
        } elseif ($format === 'csv') {
            $filename = 'products_export.csv';
            return new StreamedResponse(function () use ($products) {
                $handle = fopen('php://output', 'w');
                fputcsv($handle, ['Name', 'Category', 'Finish', 'Size', 'Structure', 'Design Category', 'Species', 'Color']);

                foreach ($products as $product) {
                   
                    fputcsv($handle, [
                        $product->name,
                        $product->category->name ?? '',
                        $product->finish->name ?? '',
                        ($product->size->size_feet ?? '') . ' (' . ($product->size->size_mm ?? '') . ')',
                        $product->structure->name ?? '',
                        $product->designCategory->name ?? '',
                        $product->species->name ?? '',
                        $product->color->name ?? '',
                    ]);
                }
                fclose($handle);
            }, 200, [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]);
        }
    }

    private function getFilteredProducts()
    {
        return Product::query()
            ->when($this->selectedCategory, function ($query) {
                $categoryIds = ProductCategory::where('id', $this->selectedCategory)
                    ->orWhere('parent_id', $this->selectedCategory)
                    ->pluck('id')
                    ->toArray();
                if (!empty($categoryIds)) {
                    $query->whereIn('product_category_id', $categoryIds);
                }
            })
            ->when($this->selectedSubCategory, fn($query) => $query->where('sub_category_id', $this->selectedSubCategory))
            ->when($this->selectedFinish, fn($query) => $query->where('finish_id', $this->selectedFinish))
            ->when($this->selectedSize, fn($query) => $query->where('size_id', $this->selectedSize))
            ->when($this->selectedStructure, fn($query) => $query->where('structure_id', $this->selectedStructure))
            ->when($this->selectedDesignCategory, fn($query) => $query->where('design_category_id', $this->selectedDesignCategory))
            ->when($this->selectedSpecies, fn($query) => $query->where('species_id', $this->selectedSpecies))
            ->when($this->selectedColor, fn($query) => $query->where('color_id', $this->selectedColor))
            ->get();
    }
}
