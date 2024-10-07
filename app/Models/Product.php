<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function mainCategories()
    {
        return $this->belongsTo(MainCategory::class);
    }
    public function subcategories()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function brands()
    {
        return $this->belongsTo(Brand::class);
    }
}
