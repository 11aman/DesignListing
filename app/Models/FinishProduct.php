<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinishProduct extends Model
{
    protected $table = 'finish_product_category';
    protected $fillable = ['finish_id', 'product_category_id'];
}
