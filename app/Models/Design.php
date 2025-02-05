<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    protected $fillable = ['name', 'design_category_id', 'species_id', 'color_id', 'structure_id'];
}
