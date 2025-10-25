<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'image_url', 'description', 'price', 'discount', 'stock', 'status'];
    
    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
