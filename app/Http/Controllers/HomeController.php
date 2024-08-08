<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; // Add this import if not already present
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;

class HomeController extends Controller
{
    //1. Properties

    //2. Constructor

    //3. Methods
    public function home(){
        //MV   C (Business Logic)
        $categories = Category::whereNotNull('rank')->orderBy('rank', 'asc')->get();
        return view('home',['categories'=>$categories]); //home.blade.php
    }
    public function show($slug){
        //dd($slug);
        $product = Product::where('slug',$slug)
        ->join('categories','products.category_id','=','categories.category_id')
        ->join('brands','products.brand_id','=','brands.id')
        ->join('sellers','products.seller_id','=','sellers.id')
        ->select('products.*', 'categories.category_name','brands.brand_name','brands.brand_logo','sellers.seller_name') // Selecting product fields and category name
        ->first();
        //dd($product->id);
        // Join with the reviews table and count the number of reviews for this product
        $customerReviewCount = DB::table('reviews')
        ->where('product_id', $product->id)
        ->count();

        $averageRating = DB::table('reviews')
        ->where('product_id', $product->id)
        ->avg('rating');
        //dd($averageRating);
        
        //1. Elequent ORM or QueryBuilder
        $reviews = Review::where('product_id',$product->id)
        ->where('users.role', '=', 'customer')
        ->join('products','products.id','=','reviews.product_id')
        ->join('users','users.id','=','reviews.customer_id')
        ->select( 'reviews.reviewContent','reviews.rating','reviews.created_at','users.name','users.surname','users.role') 
        ->get();

        $product_gallery_image_controllers = Product::join('product_gallery_image_controllers', 'products.id', '=', 'product_gallery_image_controllers.product_id')
                                                    ->get();


        $rating5 = DB::table('reviews')
        ->where('product_id', $product->id)
        ->where('rating', 5)
        ->count();
        $rating4 = DB::table('reviews')
        ->where('product_id', $product->id)
        ->where('rating', 4)
        ->count();
        $rating3 = DB::table('reviews')
        ->where('product_id', $product->id)
        ->where('rating', 3)
        ->count();
        $rating2 = DB::table('reviews')
        ->where('product_id', $product->id)
        ->where('rating', 2)
        ->count();
        $rating1 = DB::table('reviews')
        ->where('product_id', $product->id)
        ->where('rating', 1)
        ->count();
        $is_purchased_count = DB::table('orders')
        ->where('product_id', $product->id)
        ->where('customer_id', Auth::id())
        ->count();
        
        $is_purchased= $is_purchased_count>0?true:false;

        return view('shop/single-product-fullwidth',[
                                                        'product'=>$product,
                                                        'product_gallery_image_controllers' => $product_gallery_image_controllers,
                                                        'customerReviewCount'=>$customerReviewCount,
                                                        'reviews'=>$reviews,
                                                        'averageRating'=>$averageRating,
                                                        'rating5'=>$rating5,
                                                        'rating4'=>$rating4,
                                                        'rating3'=>$rating3,
                                                        'rating2'=>$rating2,
                                                        'rating1'=>$rating1,
                                                        'is_purchased'=>$is_purchased
                                                    ]); //shop.blade.php
    }
}