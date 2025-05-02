<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    // Category.php (Model)
public function products()
{
    return $this->hasMany(Product::class);
}

}
