<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'product_id',
        'qty',
        'prod_thumbnail_img',
    ];

    /**
     * Get the product that belongs to the cart.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}