<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = ['name', 'description', 'image_url'];
    
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
