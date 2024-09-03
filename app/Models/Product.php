<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Brand;
use App\Models\Unit;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;
    //1. Property
    protected $fillable = [
        'product_name',
        'product_desc',
        'unit_id',
        'brand_id',
        'category_id',
        'mrp',
        'sell_price',
        'qty_available',
        'prod_thumbnail_img',
        'prod_main_img'
    ];
    
    //3. Method
    // Define the relationship to Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Define the relationship to Unit
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    // Define the relationship to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}