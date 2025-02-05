<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = ['size_feet', 'size_mm'];

    public function finishes()
    {
        return $this->belongsToMany(Finish::class, 'design_finish_size', 'size_id', 'finish_id');
    }

    public function structures()
    {
        return $this->belongsToMany(Structure::class, 'size_structure', 'size_id', 'structure_id');
    }

}
