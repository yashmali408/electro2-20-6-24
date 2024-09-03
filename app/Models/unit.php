<?php

namespace App\Models;
use App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //.property
    use HasFactory;
    protected $fillable = [
        'unit_name',
        'unit_desc'
    ];

    //2, constructor


    
    //3, Method 
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}