<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Finish extends Model
{
    protected $fillable = ['name'];

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'design_finish_size', 'finish_id', 'size_id');
    }

    public function productCategories()
    {
        return $this->belongsToMany(ProductCategory::class, 'finish_product_category', 'finish_id', 'product_category_id');
    }
}
