<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ProductFilterController extends Controller
{
    //


    //3. Method
    public function filter(Request $request){
        //dd($request->all());
        
        //Check if q prameter comming in url
        if($request->all()){
            $q = $request->q;
            //dd($q);
            $products = DB::table('products')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->join('categories', 'products.category_id', '=', 'categories.category_id')
            ->where('products.product_name', 'like', '%' . $q . '%')
            ->get();
        }else{
            $products = DB::table('products')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->join('categories', 'products.category_id', '=', 'categories.category_id')
            ->get();
        }
       

        $brandProductCounts = DB::table('products')
        ->select('brands.brand_name', DB::raw('count(*) as productCount'))
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->groupBy('brands.brand_name')  // Include brand_name in GROUP BY
        ->get();
        return view('shop/shop-grid',[ 
                                        'brandProductCounts'=>$brandProductCounts,
                                        'products'=>$products,
                                     ]);
    }
}