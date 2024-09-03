<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;

class HomeController extends Controller
{
    //1. Properties

    //2. Constructor

    //3. Methods
    
    public function home() {
        // Fetch categories from the database
        $categories = Category::whereNotNull('rank')->orderBy('rank', 'asc')->get();
        
        // Fetch products from the database
        $products = Product::join('categories', 'products.category_id', '=', 'categories.category_id')
                           ->select('products.*', 'categories.category_name')
                           ->get();

        // Pass the categories and products to the view
        return view('home', [
            'categories' => $categories,
            'products' => $products
        ]); // home.blade.php
    }

    public function show($slug) {
        // Fetch product details based on the slug
        $product = Product::where('slug', $slug)
        ->join('categories', 'products.category_id', '=', 'categories.category_id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('sellers', 'products.seller_id', '=', 'sellers.id')
        ->select('products.*', 'categories.category_name', 'brands.brand_name', 'brands.picture', 'sellers.seller_name')
        ->first();  
        
        // Calculate the average rating of the product from the review table
        // Join with the review table and count the number of reviews
        $customerReviewCount = DB::table('reviews')
        ->where('product_id', $product->id)
        ->count();

        $averageRating = DB::table('reviews')
        ->where('product_id', $product->id)
        ->avg('rating');

        // Fetch product gallery images
        $product_gallery_image_controllers = Product::join('product_gallery_image_controllers', 'products.id', '=', 'product_gallery_image_controllers.product_id')
        ->get();

        $reviews = Review::where('product_id',$product->id)
        ->where('users.role', '=', 'customer')
        ->join('products','products.id','=','reviews.product_id')
        ->join('users','users.id','=','reviews.customer_id')
        ->select( 'reviews.reviewContent','reviews.rating','reviews.created_at','users.name','users.surname','users.role') 
        ->get();
        
        // Fetch related products (example: same category or similar criteria)
        $relatedProducts = Product::join('categories', 'products.category_id', '=', 'categories.category_id')
        ->where('products.category_id', $product->category_id)
        ->where('products.id', '!=', $product->id)
        ->select('products.*', 'categories.category_name')
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
        

        $had_given_review_previously_count = DB::table('reviews')
        ->where('product_id', $product->id)
        ->where('customer_id', Auth::id())
        ->count();
        $had_given_review_previously = ($had_given_review_previously_count>0)?true:false;

        $attributesData = DB::table('proudct_attribute_values') // Correct table name
        ->join('attributes', 'proudct_attribute_values.attribute_id', '=', 'attributes.id')
        ->join('attribute_values', 'proudct_attribute_values.attributeValue_id', '=', 'attribute_values.id')
        ->where('proudct_attribute_values.product_id',  $product->id) // Correct table name
        ->select('attributes.name as attribute_name', 'attribute_values.value as attribute_value')
        ->get()
        ->groupBy('attribute_name');

    // Prepare the formatted array
    $formattedAttributes = [];

    foreach ($attributesData as $attributeName => $values) {
        $formattedAttributes[$attributeName] = $values->pluck('attribute_value')->toArray();
    }

        // Pass the product details and related products to the view
        return view('shop/single-product-fullwidth', [
                                                        'product' => $product,
                                                        'customerReviewCount' => $customerReviewCount,
                                                        'product_gallery_image_controllers' => $product_gallery_image_controllers,
                                                        'averageRating' => $averageRating,
                                                        'products' => $relatedProducts,
                                                        'reviews'=>$reviews,
                                                        'rating5'=>$rating5,
                                                        'rating4'=>$rating4,
                                                        'rating3'=>$rating3,
                                                        'rating2'=>$rating2,
                                                        'rating1'=>$rating1,
                                                        'is_purchased'=>$is_purchased,
                                                        'had_given_review_previously'=>$had_given_review_previously,
                                                        'attributes'=>$formattedAttributes
                                                    ]); // single-product-fullwidth.blade.php
    }
}