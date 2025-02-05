<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Finish;
use App\Models\Size;
use App\Models\Structure;
use App\Models\DesignCategory;
use App\Models\Species;
use App\Models\Color;

class ImportExport extends Component
{
    use WithFileUploads;

    public $file;
    public $selectedCategory;
    public $selectedFinish;
    public $selectedSize;
    public $selectedStructure;
    public $selectedDesignCategory;
    public $selectedSpecies;
    public $selectedColor;

    public function import()
{
    $this->validate(['file' => 'required|mimes:csv,xlsx']);

    Storage::disk('public')->makeDirectory('imports');

    $path = $this->file->storeAs('imports', $this->file->getClientOriginalName(), 'public');

    $fullPath = storage_path("app/public/{$path}");

    if (!file_exists($fullPath)) {
        session()->flash('message', 'File upload failed. Please try again.');
        return;
    }

    $rows = SimpleExcelReader::create($fullPath)->getRows();

    $rows->each(function ($row) {
        if($row['Size']){
        preg_match('/([\d]+x[\d]+)\s\(([\d]+x[\d]+)\)/', $row['Size'], $matches);
    
        $sizeFeet = $matches[1] ?? null; // "12x6"
        $sizeMM = $matches[2] ?? null;   // "3600x1800"
        }
        $category = ProductCategory::where('name', $row['Category'])->first();
        if($row['SubCategory']){
            $subCategory = ProductCategory::where('name', $row['SubCategory'])->first();
        }

        $finish = Finish::where('name', $row['Finish'])->first();
        $structure = Structure::where('name', $row['Structure'])->first();
        $designCategory = DesignCategory::where('name', $row['Design Category'])->first();
        $species = Species::where('name', $row['Species'])->first();
        $color = Color::where('name', $row['Color'])->first();
        $size = Size::where('size_feet', $sizeFeet)->where('size_mm',$sizeMM)->first();

        Product::create([
            'name' => $row['Product Name'],
            'product_category_id' => $category->id ?? null,
            'sub_category_id' => $subCategory->id ?? null,
            'finish_id' => $finish->id ?? null,
            'size_id' => $size->id ?? null,
            'structure_id' => $structure->id ?? null,
            'design_category_id' => $designCategory->id ?? null,
            'species_id' => $species->id ?? null,
            'color_id' => $color->id ?? null,
        ]);
        
    });

    unlink($fullPath);

    $this->dispatch('productsImported');

    session()->flash('message', 'Products Imported Successfully!');
}



    public function downloadSample()
    {
        
        $filePath = storage_path('app/sample_products.csv');

        // Create the CSV file dynamically
        SimpleExcelWriter::create($filePath)
            ->addRow([
                'Product Name' => 'Product Name',
                'Category' => 'Category Name',
                'SubCategory' => 'Sub Category Name',
                'Finish' => 'Finish Name',
                'Size' => 'Size (Feet)',
                'Structure' => 'Structure Name',
                'Design Category' => 'Design Category Name',
                'Species' => 'Species Name',
                'Color' => 'Color Name',
            ])
            ->close();

        // Return the file as a response for download
        return response()->download($filePath)->deleteFileAfterSend(true);
            
    }

    // public function render()
    // {
    //     return view('livewire.design-filter', [
    //         'products' => Product::all(),
    //     ]);
    // }
}
