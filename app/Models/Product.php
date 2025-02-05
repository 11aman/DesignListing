<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'product_category_id', 'sub_category_id',
        'finish_id', 'size_id', 'structure_id', 'design_category_id', 'species_id', 'color_id'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'sub_category_id');
    }

    // Relationship with Finish
    public function finish()
    {
        return $this->belongsTo(Finish::class);
    }

    // Relationship with Size
    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    // Relationship with Structure
    public function structure()
    {
        return $this->belongsTo(Structure::class);
    }

    // Relationship with DesignCategory
    public function designCategory()
    {
        return $this->belongsTo(DesignCategory::class);
    }

    // Relationship with Species
    public function species()
    {
        return $this->belongsTo(Species::class);
    }

    // Relationship with Color
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
