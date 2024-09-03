<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;
    //1. Property
    protected $fillable = [
        'category_name',
        'description',
        'picture'
    ];

    //2.Constructer



    //3. Method

    protected $primaryKey = 'category_id';

    //2. Constructor

    //3. method
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}