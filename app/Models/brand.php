<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['brand_name', 'brand_logo', 'seo_meta_title', 'seo_meta_desc'];

    // You can add methods here as needed
}
