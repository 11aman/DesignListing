<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    protected $fillable = ['name'];
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'size_structure', 'structure_id', 'size_id');
    }
}
