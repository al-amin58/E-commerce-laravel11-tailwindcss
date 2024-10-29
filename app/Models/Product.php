<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_title',
        'price',
        'discount_price',
        'discount_percentage',
        'quantity',
        'sku',
        'main_category_id',
        'sub_category_id',
        'brand_id',
        'short_description',
        'full_description',
        'thumbnail_image',
        'status',
    ];
    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class, 'main_category_id');
    }
    public function subcategory() // Changed to singular
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_product');
    }
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'size_product');
    }
    public function images()
    {
        return $this->hasMany(ProductImages::class);
    }
    public function product_attributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }

}
