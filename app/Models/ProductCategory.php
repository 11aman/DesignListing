<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = ['name', 'parent_id'];

    // Get Parent Category (Belongs To)
    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id');
    }

        public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }


    // Get Subcategories (Children)
    public function subcategories()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id')->with('subcategories');
    }

    // Recursive Relationship: Get Child Subcategories
    public function childSubcategories()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id')->with('subcategories');
    }
}
